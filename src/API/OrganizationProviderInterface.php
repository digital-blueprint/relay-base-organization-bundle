<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\API;

use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;

interface OrganizationProviderInterface
{
    public function getOrganizationById(string $identifier, array $options = []): ?Organization;

    /**
     * @return Organization[]
     */
    public function getOrganizations(array $options = []): array;
}
