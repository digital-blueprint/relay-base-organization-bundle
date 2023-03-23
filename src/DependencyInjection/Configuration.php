<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\DependencyInjection;

use Dbp\Relay\BaseOrganizationBundle\DataProvider\OrganizationDataProvider;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dbp_relay_base_organization');

        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        $rootNode->append(OrganizationDataProvider::getLocalDataConfigNodeDefinition());

        return $treeBuilder;
    }
}
