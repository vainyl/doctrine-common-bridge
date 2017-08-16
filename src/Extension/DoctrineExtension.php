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

use Doctrine\Common\Cache\ArrayCache;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Exception\MissingRequiredServiceException;
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\AbstractFrameworkExtension;
use Vainyl\Doctrine\Common\Cache\DoctrineApcuCache;
use Vainyl\Doctrine\Common\Cache\DoctrineRedisCache;
use Vainyl\Doctrine\Common\Exception\UnknownCacheDriverException;

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
        return [
            [new DoctrineConnectionCompilerPass()],
            [new DoctrineManagerCompilerPass()],
            [new DoctrineMappingDriverDecoratorCompilerPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, -1],
        ];
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
        switch ($doctrineConfig['cache']['driver']) {
            case 'memory':
                $class = ArrayCache::class;
                $arguments = [];
                break;
            case 'apcu':
                $class = DoctrineApcuCache::class;
                $arguments = [];
                break;
            case 'redis':
                $class = DoctrineRedisCache::class;
                $arguments = [new Reference('@database.' . $doctrineConfig['cache']['options']['database'])];
                break;
            default:
                throw new UnknownCacheDriverException($container, $doctrineConfig['cache']);
        }

        $container->setDefinition('doctrine.cache', new Definition($class, $arguments));

        $container->findDefinition('doctrine.settings')
                  ->replaceArgument(1, $doctrineConfig['config']['driver'])
                  ->replaceArgument(2, $doctrineConfig['paths']);

        return $this;
    }
}