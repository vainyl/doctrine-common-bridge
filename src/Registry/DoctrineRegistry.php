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

namespace Vainyl\Doctrine\Common\Registry;

use Doctrine\Common\Persistence\AbstractManagerRegistry;
use Doctrine\Common\Proxy\Proxy;
use Psr\Container\ContainerInterface;

/**
 * Class DoctrineRegistry
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DoctrineRegistry extends AbstractManagerRegistry
{
    private $container;

    /**
     * DoctrineRegistry constructor.
     *
     * @param ContainerInterface $container
     * @param array              $connections
     * @param array              $managers
     */
    public function __construct(ContainerInterface $container, array $connections = [], array $managers = [])
    {
        $this->container = $container;
        parent::__construct('registry', $connections, $managers, null, null, Proxy::class);
    }

    /**
     * @inheritDoc
     */
    protected function getService($name)
    {
        return $this->container->get($name);
    }

    /**
     * @inheritDoc
     */
    protected function resetService($name)
    {
        return;
    }

    /**
     * @inheritDoc
     */
    public function getAliasNamespace($alias)
    {
        return '';
    }
}
