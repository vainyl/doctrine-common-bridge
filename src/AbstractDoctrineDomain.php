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

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Domain\DomainInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class AbstractDoctrineDomain
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDoctrineDomain extends AbstractIdentifiable implements DomainInterface
{
    protected $createdAt;

    protected $updatedAt;

    /**
     * @inheritDoc
     */
    public function createdAt(): TimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(TimeInterface $time): DomainInterface
    {
        $this->createdAt = $time;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(TimeInterface $time): DomainInterface
    {
        $this->updatedAt = $time;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function updatedAt(): TimeInterface
    {
        return $this->updatedAt;
    }
}