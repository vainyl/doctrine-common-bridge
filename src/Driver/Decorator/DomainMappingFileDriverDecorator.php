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

namespace Vainyl\Doctrine\Common\Driver\Decorator;

use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Vainyl\Doctrine\Common\Exception\NoMetadataAliasException;
use Vainyl\Doctrine\Common\Metadata\DoctrineDomainMetadataInterface;

/**
 * Class DomainMappingFileDriverDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DomainMappingFileDriverDecorator extends AbstractDoctrineFileDriverDecorator
{
    /**
     * @param string                          $className
     * @param DoctrineDomainMetadataInterface $metadata
     *
     * @throws NoMetadataAliasException
     */
    public function loadMetadataForClass($className, ClassMetadata $metadata)
    {
        parent::loadMetadataForClass($className, $metadata);

        $element = $this->getElement($className);
        if (!isset($element['alias'])) {
            throw new NoMetadataAliasException($this, $className);
        }

        $metadata->setAlias($element['alias']);
    }
}