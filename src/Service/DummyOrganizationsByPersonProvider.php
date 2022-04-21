<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Service;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationsByPersonProviderInterface;

class DummyOrganizationsByPersonProvider implements OrganizationsByPersonProviderInterface
{
    /**
     * @return string[]
     */
    public function getOrganizationsByPerson(string $personId, array $options = []): array
    {
        return [];
    }
}
