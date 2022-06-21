<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Service;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationsByPersonProviderInterface;
use Dbp\Relay\CoreBundle\Pagination\Paginator;
use Dbp\Relay\CoreBundle\Pagination\WholeResultPaginator;

class DummyOrganizationsByPersonProvider implements OrganizationsByPersonProviderInterface
{
    public function getOrganizationsByPerson(string $personId, array $options = []): Paginator
    {
        return new WholeResultPaginator([], 1, 30);
    }
}
