<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\LocalData\LocalData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class OrganizationItemDataProvider extends AbstractController implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $api;

    public function __construct(OrganizationProviderInterface $api)
    {
        $this->api = $api;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Organization::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Organization
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $filters = $context['filters'] ?? [];

        $options = [];
        $options['lang'] = $filters['lang'] ?? 'de';
        $options[LocalData::INCLUDE_PARAMETER_NAME] = LocalData::getIncludeParameter($filters);

        return $this->api->getOrganizationById($id, $options);
    }
}
