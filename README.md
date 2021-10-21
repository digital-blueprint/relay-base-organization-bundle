# DbpRelayBaseOrganizationBundle

[GitLab](https://gitlab.tugraz.at/dbp/relay/dbp-relay-base-organization-bundle) | [Packagist](https://packagist.org/packages/dbp/relay-base-organization-bundle)

## Integration into the Relay API Server

* Add the bundle package as a dependency:

```
composer require dbp/relay-base-organization-bundle
```

* Add the bundle to your `config/bundles.php` in front of `DbpRelayCoreBundle`:

```php
...
Dbp\Relay\BaseOrganizationBundle\DbpRelayBaseOrganizationBundle::class => ['all' => true],
Dbp\Relay\CoreBundle\DbpRelayCoreBundle => ['all' => true],
];
```

* Run `composer install` to clear caches

## OrganizationProvider service

For services that need to fetch organizations you need to create a service that implements
[OrganizationProviderInterface](https://gitlab.tugraz.at/dbp/relay/dbp-relay-base-organization-bundle/-/blob/main/src/API/OrganizationProviderInterface.php)
in your application.

### Example

#### Service class

You can for example put below code into `src/Service/OrganizationProvider.php`:

```php
<?php

declare(strict_types=1);

namespace YourUniversity\Service;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;

class OrganizationProvider implements OrganizationProviderInterface
{
    public function getOrganizationById(string $identifier, string $lang): Organization
    {
        return some_method_that_fetches_an_organization_by_id($identifier, $lang);
    }

    /**
     * @return Organization[]
     */
    public function getOrganizationsByPerson(Person $person, string $context, string $lang): array
    {
        return some_method_that_fetches_an_organization_by_person($person, $context, $lang);
    }

    /**
     * @return Organization[]
     */
    public function getOrganizations(string $lang): array
    {
        return some_method_that_fetches_all_organizations($lang);
    }
}
```

#### Services configuration

For above class you need to add this to your `src/Resources/config/services.yaml`:

```yaml
  Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface:
    '@YourUniversity\Service\OrganizationProvider'
```
