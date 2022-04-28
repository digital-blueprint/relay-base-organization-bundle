<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\API\OrganizationsByPersonProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Dbp\Relay\CoreBundle\LocalData\LocalData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class OrganizationCollectionDataProvider extends AbstractController implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public const ITEMS_PER_PAGE = 250;

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

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): ArrayFullPaginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $filters = $context['filters'] ?? [];

        $options = ['lang' => $filters['lang'] ?? 'de'];
        $options[LocalData::INCLUDE_PARAMETER_NAME] = LocalData::getIncludeParameter($filters);

        $personId = $filters['person'] ?? null;
        if (!empty($personId)) {
            if ($personId !== $this->getUser()->getUserIdentifier()) {
                throw new ApiError(Response::HTTP_UNAUTHORIZED, 'only allowed with ID of currently logged-in person');
            }

            $organizations = [];
            foreach ($this->organizationsByPersonProvider->getOrganizationsByPerson($personId, $options) as $organizationId) {
                $organizations[] = $this->organizationProvider->getOrganizationById($organizationId, $options);
            }
        } else {
            $organizations = $this->organizationProvider->getOrganizations($options);
        }

        $perPage = self::ITEMS_PER_PAGE;
        $page = 1;
        if (isset($context['filters']['page'])) {
            $page = (int) $context['filters']['page'];
        }

        if (isset($context['filters']['perPage'])) {
            $perPage = (int) $context['filters']['perPage'];
        }

        return new ArrayFullPaginator($organizations, $page, $perPage);
    }
}
