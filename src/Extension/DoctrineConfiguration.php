<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Doctrine-Common-Bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Doctrine\Common\Extension;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class DoctrineConfiguration
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DoctrineConfiguration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('doctrine');

        $rootNode
            ->children()
                ->arrayNode('cache')
                    ->children()
                        ->scalarNode('driver')->defaultValue('apcu')->end()
                        ->arrayNode('options')
                            ->prototype('variable')->end()
                            ->defaultValue([])
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('driver')->defaultValue('yaml')->end()
                    ->end()
                ->end()
                ->arrayNode('paths')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('dir')->end()
                            ->scalarNode('prefix')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}