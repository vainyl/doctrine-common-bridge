<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Doctrine-orm-bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Doctrine\Common\Factory;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Storage\ConnectionStorage;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Doctrine\Common\Database\DoctrineMysqlConnection;
use Vainyl\Doctrine\Common\Database\DoctrinePostgresqlConnection;
use Vainyl\Doctrine\Common\Exception\UnknownDoctrineDriverTypeException;

/**
 * Class DoctrineConnectionFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DoctrineConnectionFactory extends AbstractIdentifiable
{
    private $connectionStorage;

    /**
     * DoctrineConnectionFactory constructor.
     *
     * @param ConnectionStorage $connectionStorage
     */
    public function __construct(ConnectionStorage $connectionStorage)
    {
        $this->connectionStorage = $connectionStorage;
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return 'doctrine';
    }

    /**
     * @inheritDoc
     */
    public function createConnection(string $connectionName) : ConnectionInterface
    {
        $type = 'pgsql';
        switch ($type) {
            case 'pgsql':
                return new DoctrinePostgresqlConnection($this->connectionStorage->getConnection($connectionName));
                break;
            case 'mysql':
                return new DoctrineMysqlConnection($this->connectionStorage->getConnection($connectionName));
                break;
            default:
                throw new UnknownDoctrineDriverTypeException($this, $type);
        }
    }
}
