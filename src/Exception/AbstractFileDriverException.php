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

namespace Vainyl\Doctrine\Common\Exception;

use Doctrine\Common\Persistence\Mapping\Driver\FileDriver;
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractEntityDriverException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractFileDriverException extends AbstractCoreException implements FileDriverExceptionInterface
{
    private $driver;

    /**
     * AbstractEntityDriverException constructor.
     *
     * @param FileDriver      $driver
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct(FileDriver $driver, string $message, int $code = 500, \Exception $previous = null)
    {
        $this->driver = $driver;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getDriver(): FileDriver
    {
        return $this->driver;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['driver' => spl_object_hash($this->driver)], parent::toArray());
    }
}