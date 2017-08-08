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

namespace Vainyl\Doctrine\Common;

use Vainyl\Core\AbstractArray;
use Doctrine\Common\Cache\Cache as DoctrineCacheInterface;

/**
 * Class DoctrineSettings
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DoctrineSettings extends AbstractArray
{
    private $cache;

    private $driverName;

    private $extraPaths = [];

    /**
     * DoctrineSettings constructor.
     *
     * @param DoctrineCacheInterface $cache
     * @param string                 $driverName
     * @param array                  $extraPaths
     */
    public function __construct(DoctrineCacheInterface $cache, string $driverName, array $extraPaths = [])
    {
        $this->cache = $cache;
        $this->driverName = $driverName;
        $this->extraPaths = $extraPaths;
    }

    /**
     * @return DoctrineCacheInterface
     */
    public function getCache(): DoctrineCacheInterface
    {
        return $this->cache;
    }

    /**
     * @return string
     */
    public function getDriverName(): string
    {
        return $this->driverName;
    }

    /**
     * @return array
     */
    public function getExtraPaths(): array
    {
        return $this->extraPaths;
    }
}