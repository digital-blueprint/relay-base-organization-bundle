<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DependencyInjection;

use Dbp\Relay\BaseOrganizationBundle\DataProvider\OrganizationDataProvider;
use Dbp\Relay\CoreBundle\Extension\ExtensionTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class DbpRelayBaseOrganizationExtension extends ConfigurableExtension
{
    use ExtensionTrait;

    public function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $this->addResourceClassDirectory($container, __DIR__.'/../Entity');

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

        $defintion = $container->getDefinition(OrganizationDataProvider::class);
        $defintion->addMethodCall('setConfig', [$mergedConfig]);
    }
}
