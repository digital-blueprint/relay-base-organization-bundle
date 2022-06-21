<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Service;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\Pagination\Paginator;
use Dbp\Relay\CoreBundle\Pagination\WholeResultPaginator;

class DummyOrganizationProvider implements OrganizationProviderInterface
{
    public function getOrganizationById(string $identifier, array $options = []): Organization
    {
        $org = new Organization();
        $org->setIdentifier($identifier);
        $org->setName('Example Organization');

        return $org;
    }

    public function getOrganizations(array $options = []): Paginator
    {
        return new WholeResultPaginator([$this->getOrganizationById('foo', $options)], 1, 30);
    }
}
