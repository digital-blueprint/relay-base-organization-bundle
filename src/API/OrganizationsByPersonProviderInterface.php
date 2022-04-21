<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\API;

interface OrganizationsByPersonProviderInterface
{
    /**
     * @return string[]
     */
    public function getOrganizationsByPerson(string $personId, array $options = []): array;
}
