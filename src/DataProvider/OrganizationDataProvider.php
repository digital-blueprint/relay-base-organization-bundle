<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DataProvider;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\DataProvider\AbstractDataProvider;
use Dbp\Relay\CoreBundle\Locale\Locale;

class OrganizationDataProvider extends AbstractDataProvider
{
    /** @var OrganizationProviderInterface */
    private $organizationProvider;

    public function __construct(OrganizationProviderInterface $organizationProvider)
    {
        $this->organizationProvider = $organizationProvider;
    }

    protected function getResourceClass(): string
    {
        return Organization::class;
    }

    protected function isUserGrantedOperationAccess(int $operation): bool
    {
        return $this->isUserAuthenticated();
    }

    protected function getItemById($id, array $filters = [], array $options = []): object
    {
        //-------------------------------------------------------------------------
        // @deprecate 'lang' query parameter is deprecate, use 'Accept-Language' header instead
        $this->tryAddDeprecatedLangQueryParameter($options, $filters);
        //-------------------------------------------------------------------------

        return $this->organizationProvider->getOrganizationById($id, $options);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        //-------------------------------------------------------------------------
        // @deprecate 'lang' query parameter is deprecate, use 'Accept-Language' header instead
        $this->tryAddDeprecatedLangQueryParameter($options, $filters);
        //-------------------------------------------------------------------------

        if ($search = ($filters['search'] ?? null)) {
            $options['search'] = $search;
        }

        return $this->organizationProvider->getOrganizations($currentPageNumber, $maxNumItemsPerPage, $options);
    }

    /**
     * @deprecate 'lang' query parameter is deprecated, use 'Accept-Language' header instead
     */
    private function tryAddDeprecatedLangQueryParameter(array &$targetOptions, array $filters)
    {
        if (($lang = $filters['lang'] ?? null) !== null) {
            $targetOptions[Locale::LANGUAGE_OPTION] = $lang;
        }
    }
}
