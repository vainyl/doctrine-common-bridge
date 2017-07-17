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

use Doctrine\Common\Collections\Collection;
use Vainyl\Core\ArrayInterface;
use Vainyl\Core\NameableInterface;

/**
 * Class AbstractDoctrineDomain
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDoctrineDomain implements ArrayInterface, NameableInterface, \JsonSerializable
{
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
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $field => $value) {
            switch (true) {
                case (false === is_object($value)):
                    $array[$field] = $value;
                    break;
                case ($value instanceof ArrayInterface):
                    $array[$field] = $value->toArray();
                    break;
                case ($value instanceof Collection):
                    /**
                     * @var ArrayInterface $item
                     */
                    foreach ($value->toArray() as $item) {
                        $array[$field][] = $item->toArray();
                    }
            }
        }

        return $array;
    }
}