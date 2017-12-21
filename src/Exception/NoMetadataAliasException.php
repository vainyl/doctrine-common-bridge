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
 * Class NoMetadataAliasException
 *
 * @deprecated Not used
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NoMetadataAliasException extends AbstractFileDriverException
{
    private $className;

    /**
     * NoMetadataAliasException constructor.
     *
     * @param FileDriver $driver
     * @param string     $className
     */
    public function __construct(FileDriver $driver, string $className)
    {
        parent::__construct($driver, sprintf('No alias set for %s', $className));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['className' => $this->className], parent::toArray());
    }
}
