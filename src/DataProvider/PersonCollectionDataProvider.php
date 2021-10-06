<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseBundle\API\PersonProviderInterface;
use Dbp\Relay\BaseBundle\Entity\Person;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PersonCollectionDataProvider extends AbstractController implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public const ITEMS_PER_PAGE = 250;

    private $api;

    public function __construct(PersonProviderInterface $api)
    {
        $this->api = $api;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Person::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): ArrayFullPaginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $perPage = self::ITEMS_PER_PAGE;
        $page = 1;
        $api = $this->api;
        $filters = $context['filters'] ?? [];

        if (isset($context['filters']['page'])) {
            $page = (int) $context['filters']['page'];
        }

        if (isset($context['filters']['perPage'])) {
            $perPage = (int) $context['filters']['perPage'];
        }

        $persons = $api->getPersons($filters);

        // TODO: do pagination via API
        $pagination = new ArrayFullPaginator($persons, $page, $perPage);

        return $pagination;
    }
}
