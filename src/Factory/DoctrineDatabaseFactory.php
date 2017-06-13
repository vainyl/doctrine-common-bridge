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

namespace Vainyl\Doctrine\Common\Factory;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Doctrine\Common\Database\DoctrineDatabase;

/**
 * Class DoctrineDatabaseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DoctrineDatabaseFactory
{
    private $connectionStorage;

    private $config;

    private $eventManager;

    /**
     * PdoDatabaseFactory constructor.
     *
     * @param StorageInterface $connectionStorage
     */
    public function __construct(
        StorageInterface $connectionStorage,
        Configuration $config,
        EventManager $eventManager
    ) {
        $this->connectionStorage = $connectionStorage;
    }

    /**
     * @param string $name
     * @param array  $configData
     *
     * @return DoctrineDatabase
     */
    public function createDatabase(string $name, array $configData): DoctrineDatabase
    {
        return new DoctrineDatabase(
            $configData,
            $this->config,
            $this->connectionStorage[$configData['connection']],
            $this->eventManager
        );
    }
}