<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\API;

use Dbp\Relay\CoreBundle\Exception\ApiError;

interface OrganizationsByPersonProviderInterface
{
    /**
     * @return string[]
     *
     * @throws ApiError
     */
    public function getOrganizationsByPerson(string $personId, array $options = []): array;
}
