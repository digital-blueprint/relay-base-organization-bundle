<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Service;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\BasePersonBundle\Entity\Person;

class DummyOrganizationProvider implements OrganizationProviderInterface
{
    public function getOrganizationById(string $identifier, array $options = []): ?Organization
    {
        $org = new Organization();
        $org->setIdentifier($identifier);
        $org->setName('Example Organization');

        return $org;
    }

    public function getOrganizationsByPerson(Person $person, string $context, array $options = []): array
    {
        $orgs = [];
        $org = $this->getOrganizationById('foo', $options);
        if ($org !== null) {
            $orgs[] = $org;
        }

        return $orgs;
    }

    public function getOrganizations(array $options = []): array
    {
        $orgs = [];
        $org = $this->getOrganizationById('foo', $options);
        if ($org !== null) {
            $orgs[] = $org;
        }

        return $orgs;
    }
}
