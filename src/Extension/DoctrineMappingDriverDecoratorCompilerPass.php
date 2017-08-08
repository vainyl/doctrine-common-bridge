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

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DoctrineMappingDriverDecoratorCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DoctrineMappingDriverDecoratorCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        foreach ($container->findTaggedServiceIds('mapping.driver.decorator') as $id => $tags) {
            $container->removeDefinition($id);
        }
    }
}