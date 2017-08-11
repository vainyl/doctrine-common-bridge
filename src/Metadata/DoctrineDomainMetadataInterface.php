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

namespace Vainyl\Doctrine\Common\Metadata;

use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Vainyl\Domain\Metadata\DomainMetadataInterface;

/**
 * Interface DoctrineDomainMetadataInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DoctrineDomainMetadataInterface extends ClassMetadata
{
    /**
     * @return DomainMetadataInterface
     */
    public function getDomainMetadata(): DomainMetadataInterface;
}