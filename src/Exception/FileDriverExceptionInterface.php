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

/**
 * Interface FileDriverExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface FileDriverExceptionInterface extends \Throwable
{
    /**
     * @return FileDriver
     */
    public function getDriver(): FileDriver;
}