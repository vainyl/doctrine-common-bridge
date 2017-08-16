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

namespace Vainyl\Doctrine\Common\Exception;

use Symfony\Component\DependencyInjection\Container;
use Vainyl\Core\Exception\AbstractContainerException;

/**
 * Class UnknownCacheDriverException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnknownCacheDriverException extends AbstractContainerException
{
    private $driver;

    /**
     * UnknownCacheDriverException constructor.
     *
     * @param Container $container
     * @param string    $driver
     */
    public function __construct(Container $container, string $driver)
    {
        $this->driver = $driver;
        parent::__construct($container, sprintf('Unknown doctrine cache driver %s', $driver));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['driver' => $this->driver], parent::toArray());
    }
}
