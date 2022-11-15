<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DataProvider;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\API\OrganizationsByPersonProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\DataProvider\AbstractDataProvider;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Locale\Locale;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class OrganizationDataProvider extends AbstractDataProvider
{
    /** @var OrganizationProviderInterface */
    private $organizationProvider;

    /** @var OrganizationsByPersonProviderInterface */
    private $organizationsByPersonProvider;

    /** @var RequestStack */
    private $requestStack;

    public function __construct(OrganizationProviderInterface $organizationProvider, OrganizationsByPersonProviderInterface $organizationsByPersonProvider, RequestStack $requestStack)
    {
        $this->organizationProvider = $organizationProvider;
        $this->organizationsByPersonProvider = $organizationsByPersonProvider;
        $this->requestStack = $requestStack;
    }

    protected function getResourceClass(): string
    {
        return Organization::class;
    }

    protected function getItemById($id, array $options = []): object
    {
        //-------------------------------------------------------------------------
        // @deprecate 'lang' query parameter is deprecate, use 'Accept-Language' header instead
        $queryParameters = $this->requestStack->getCurrentRequest()->query->all();
        $this->tryAddDeprecatedLangQueryParameter($options, $queryParameters);
        //-------------------------------------------------------------------------

        return $this->organizationProvider->getOrganizationById($id, $options);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        //-------------------------------------------------------------------------
        // @deprecate 'lang' query parameter is deprecate, use 'Accept-Language' header instead
        $this->tryAddDeprecatedLangQueryParameter($options, $filters);
        //-------------------------------------------------------------------------

        //-------------------------------------------------------------------------
        // @deprecate The 'person' filter is deprecate. Use the 'identifiers' filter in your custom organization wrapper.
        $personId = $filters['person'] ?? '';
        if ($personId !== '') {
            if ($personId !== $this->getUser()->getUserIdentifier()) {
                throw new ApiError(Response::HTTP_UNAUTHORIZED, 'only allowed with ID of currently logged-in person');
            }

            $organizations = [];
            foreach ($this->organizationsByPersonProvider->getOrganizationsByPerson($personId, $options) as $organizationId) {
                $organizations[] = $this->organizationProvider->getOrganizationById($organizationId, $options);
            }

            return $organizations;
        }
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
