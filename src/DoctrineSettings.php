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

    private $extraPaths = [];

    /**
     * DoctrineSettings constructor.
     *
     * @param DoctrineCacheInterface $cache
     * @param array                  $extraPaths
     */
    public function __construct(DoctrineCacheInterface $cache, array $extraPaths = [])
    {
        $this->cache = $cache;
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
     * @return array
     */
    public function getExtraPaths(): array
    {
        return $this->extraPaths;
    }
}