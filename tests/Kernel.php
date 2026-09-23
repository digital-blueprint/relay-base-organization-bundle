<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Tests;

use Dbp\Relay\BaseOrganizationBundle\DbpRelayBaseOrganizationBundle;
use Dbp\Relay\CoreBundle\TestUtils\CoreTestKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use CoreTestKernelTrait;

    protected function registerAdditionalBundles(): iterable
    {
        yield new DbpRelayBaseOrganizationBundle();
    }

    protected function configureAdditionalContainer(ContainerConfigurator $container): void
    {
        $container->extension('dbp_relay_base_organization', [
            'authorization' => [
                'roles' => [
                    'ROLE_READER' => 'user.get("MAY_READ")',
                ],
            ],
        ]);
    }
}
