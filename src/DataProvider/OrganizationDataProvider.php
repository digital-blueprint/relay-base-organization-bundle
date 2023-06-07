<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DataProvider;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\CoreBundle\ApiPlatform\State\AbstractStateProvider;

class OrganizationDataProvider extends AbstractStateProvider
{
    /** @var OrganizationProviderInterface */
    private $organizationProvider;

    public function __construct(OrganizationProviderInterface $organizationProvider)
    {
        $this->organizationProvider = $organizationProvider;
    }

    protected function isUserGrantedOperationAccess(int $operation): bool
    {
        return $this->isAuthenticated();
    }

    protected function getItemById($id, array $filters = [], array $options = []): object
    {
        return $this->organizationProvider->getOrganizationById($id, $options);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        if ($search = ($filters['search'] ?? null)) {
            $options['search'] = $search;
        }

        return $this->organizationProvider->getOrganizations($currentPageNumber, $maxNumItemsPerPage, $options);
    }
}
