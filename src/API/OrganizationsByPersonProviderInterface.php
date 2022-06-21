<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\API;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Pagination\Paginator;

interface OrganizationsByPersonProviderInterface
{
    /**
     * @throws ApiError
     */
    public function getOrganizationsByPerson(string $personId, array $options = []): Paginator;
}
