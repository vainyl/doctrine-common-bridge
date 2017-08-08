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

/**
 * Interface DoctrineDomainMetadataInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DoctrineDomainMetadataInterface extends ClassMetadata
{
    /**
     * @param string $alias
     *
     * @return DoctrineDomainMetadataInterface
     */
    public function setAlias(string $alias): DoctrineDomainMetadataInterface;

    /**
     * @param array $scenarios
     *
     * @return DoctrineDomainMetadataInterface
     */
    public function setScenarios(array $scenarios) : DoctrineDomainMetadataInterface;

    /**
     * @return string
     */
    public function getAlias() : string;

    /**
     * @return array
     */
    public function getScenarios() : array;
}