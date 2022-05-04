<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\API;

use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\Exception\ApiError;

interface OrganizationProviderInterface
{
    /**
     * @throws ApiError
     */
    public function getOrganizationById(string $identifier, array $options = []): Organization;

    /**
     * @return Organization[]
     *
     * @throws ApiError
     */
    public function getOrganizations(array $options = []): array;
}
