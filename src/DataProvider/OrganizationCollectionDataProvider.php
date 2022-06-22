<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\PaginatorInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\API\OrganizationsByPersonProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\LocalData\LocalData;
use Dbp\Relay\CoreBundle\Pagination\Pagination;
use Dbp\Relay\CoreBundle\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class OrganizationCollectionDataProvider extends AbstractController implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public const MAX_ITEMS_PER_PAGE = 250;

    /** @var OrganizationProviderInterface */
    private $organizationProvider;

    /** @var OrganizationsByPersonProviderInterface */
    private $organizationsByPersonProvider;

    public function __construct(OrganizationProviderInterface $organizationProvider, OrganizationsByPersonProviderInterface $organizationsByPersonProvider)
    {
        $this->organizationProvider = $organizationProvider;
        $this->organizationsByPersonProvider = $organizationsByPersonProvider;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Organization::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): Paginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $filters = $context['filters'] ?? [];

        $options = ['lang' => $filters['lang'] ?? 'de'];
        $options[LocalData::INCLUDE_PARAMETER_NAME] = LocalData::getIncludeParameter($filters);

        if ($search = ($filters['search'] ?? null)) {
            $options['search'] = $search;
        }

        Pagination::addPaginationOptions($options, $filters, self::MAX_ITEMS_PER_PAGE);

        $personId = $filters['person'] ?? '';
        if ($personId !== '') {
            if ($personId !== $this->getUser()->getUserIdentifier()) {
                throw new ApiError(Response::HTTP_UNAUTHORIZED, 'only allowed with ID of currently logged-in person');
            }

            $organizations = [];
            $orgIdPaginator = $this->organizationsByPersonProvider->getOrganizationsByPerson($personId, $options);
            foreach ($orgIdPaginator as $organizationId) {
                $organizations[] = $this->organizationProvider->getOrganizationById($organizationId, $options);
            }

            if ($orgIdPaginator instanceof PaginatorInterface) {
                $paginator = Pagination::createFullPaginator($organizations, $options, intval($orgIdPaginator->getTotalItems()));
            } else {
                $paginator = Pagination::createPartialPaginator($organizations, $options);
            }
        } else {
            $paginator = $this->organizationProvider->getOrganizations($options);
        }

        return $paginator;
    }
}
