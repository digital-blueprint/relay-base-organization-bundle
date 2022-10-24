<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\API;

use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Pagination\Paginator;

interface OrganizationProviderInterface
{
    /**
     * @param array $options Available options:
     *                       * 'lang' ('de' or 'en')
     *                       * LocalData::INCLUDE_PARAMETER_NAME
     *
     * @throws ApiError
     */
    public function getOrganizationById(string $identifier, array $options = []): Organization;

    /**
     * @param array $options Available options:
     *                       * string 'lang' ('de' or 'en')
     *                       * array 'identifiers' The list of organizations to return
     *                       * string Organization::SEARCH_PARAMETER_NAME (partial, case-insensitive text search on 'name' attribute)
     *                       * string LocalData::INCLUDE_PARAMETER_NAME
     *                       * string LocalData::QUERY_PARAMETER_NAME
     *
     * @throws ApiError
     */
    public function getOrganizations(array $options = []): Paginator;
}
