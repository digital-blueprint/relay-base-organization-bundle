<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DependencyInjection;

use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\BaseOrganizationBundle\DataProvider\OrganizationDataProvider;
use Dbp\Relay\BaseOrganizationBundle\Service\DummyOrganizationProvider;
use Dbp\Relay\CoreBundle\Extension\ExtensionTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class DbpRelayBaseOrganizationExtension extends ConfigurableExtension
{
    use ExtensionTrait;

    public function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $this->addResourceClassDirectory($container, __DIR__.'/../Entity');

        $container->register(OrganizationDataProvider::class)
            ->setAutowired(true)
            ->setAutoconfigured(true);

        $container->register(DummyOrganizationProvider::class)
            ->setAutowired(true)
            ->setAutoconfigured(true);

        $container->setAlias(
            OrganizationProviderInterface::class,
            DummyOrganizationProvider::class
        );

        $defintion = $container->getDefinition(OrganizationDataProvider::class);
        $defintion->addMethodCall('setConfig', [$mergedConfig]);
    }
}
