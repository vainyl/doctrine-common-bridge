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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vainyl\Core\Exception\MissingRequiredServiceException;
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\AbstractFrameworkExtension;

/**
 * Class DoctrineExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DoctrineExtension extends AbstractFrameworkExtension
{
    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [new DoctrineConnectionCompilerPass(), new DoctrineManagerCompilerPass()];
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        parent::load($configs, $container);

        if (false === $container->hasDefinition('doctrine.settings')) {
            throw new MissingRequiredServiceException($container, 'doctrine.settings');
        }

        $configuration = new DoctrineConfiguration();
        $doctrineConfig = $this->processConfiguration($configuration, $configs);

        $container->setAlias('doctrine.cache', 'doctrine.cache.' . $doctrineConfig['cache']);

        $container->findDefinition('doctrine.settings')
                  ->replaceArgument(1, $doctrineConfig['driver'])
                  ->replaceArgument(2, $doctrineConfig['paths']);

        return $this;
    }
}