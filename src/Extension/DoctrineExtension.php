<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Doctrine-common-bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Doctrine\Common\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\AbstractFrameworkExtension;
use Vainyl\Doctrine\Common\DoctrineSettings;

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

        $configuration = new DoctrineConfiguration();
        $doctrineConfig = $this->processConfiguration($configuration, $configs);

        $container->setAlias('doctrine.cache', 'doctrine.cache.' . $doctrineConfig['cache']);

        $settingsDefinition = (new Definition())
            ->setClass(DoctrineSettings::class)
            ->setArguments([new Reference('doctrine.cache'), $doctrineConfig['paths']]);
        $container->setDefinition('doctrine.settings', $settingsDefinition);

        return $this;
    }
}