<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use Dbp\Relay\CoreBundle\Helpers\Locale;
use Dbp\Relay\CoreBundle\LocalData\LocalData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class OrganizationItemDataProvider extends AbstractController implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var OrganizationProviderInterface */
    private $api;

    /** @var Locale */
    private $locale;

    public function __construct(OrganizationProviderInterface $api, Locale $locale)
    {
        $this->api = $api;
        $this->locale = $locale;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Organization::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Organization
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $filters = $context['filters'] ?? [];
        $options = [];

        LocalData::addOptions($options, $filters);

        // @deprecate 'lang' filter is deprecate, use 'Accept-Language' header instead
        if (($lang = $filters['lang'] ?? null) !== null) {
            $options[Locale::LANGUAGE_OPTION] = $lang;
        } else {
            $this->locale->addLanguageOption($options);
        }

        return $this->api->getOrganizationById($id, $options);
    }
}
