<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Service;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\BasePersonBundle\Entity\Person;

class DummyOrganizationProvider implements OrganizationProviderInterface
{
    public function getOrganizationById(string $identifier, string $lang): Organization
    {
        $org = new Organization();
        $org->setIdentifier($identifier);
        $org->setName('Example Organization');
        $org->setAlternateName('F1234');
        $org->setUrl('https://example.com');

        return $org;
    }

    public function getOrganizationsByPerson(Person $person, string $context, string $lang): array
    {
        $org = $this->getOrganizationById($context, $lang);

        return [$org];
    }

    public function getOrganizations(string $lang): array
    {
        $org = $this->getOrganizationById('1234', $lang);

        return [$org];
    }
}
