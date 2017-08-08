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
use Doctrine\Common\Persistence\Mapping\Driver\FileDriver as DoctrineFileDriver;
use Doctrine\Common\Persistence\Mapping\Driver\FileLocator;
use Vainyl\Core\IdentifiableInterface;

/**
 * Class AbstractDoctrineFileDriverDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDoctrineFileDriverDecorator extends DoctrineFileDriver implements IdentifiableInterface
{
    private $driver;

    /**
     * AbstractDoctrineDriverDecorator constructor.
     *
     * @param DoctrineFileDriver $driver
     */
    public function __construct(DoctrineFileDriver $driver)
    {
        $this->driver = $driver;
        parent::__construct($driver->getLocator());
    }

    /**
     * @param IdentifiableInterface $obj
     *
     * @return bool
     */
    public function equals($obj): bool
    {
        return $this->getId() === $obj->getId();
    }

    /**
     * @inheritDoc
     */
    public function getAllClassNames()
    {
        return $this->driver->getAllClassNames();
    }

    /**
     * @inheritDoc
     */
    public function getElement($className)
    {
        return $this->driver->getElement($className);
    }

    /**
     * @inheritDoc
     */
    public function getGlobalBasename()
    {
        return $this->driver->getGlobalBasename();
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?string
    {
        return spl_object_hash($this);
    }

    /**
     * @inheritDoc
     */
    public function getLocator()
    {
        return $this->driver->getLocator();
    }

    /**
     * @inheritDoc
     */
    public function hash()
    {
        return $this->getId();
    }

    /**
     * @inheritDoc
     */
    protected function initialize()
    {
        $this->driver->initialize();
    }

    /**
     * @inheritDoc
     */
    public function isTransient($className)
    {
        return $this->driver->isTransient($className);
    }

    /**
     * @inheritDoc
     */
    protected function loadMappingFile($file)
    {
        $this->driver->loadMappingFile($file);
    }

    /**
     * @inheritDoc
     */
    public function loadMetadataForClass($className, ClassMetadata $metadata)
    {
        $this->driver->loadMetadataForClass($className, $metadata);
    }

    /**
     * @inheritDoc
     */
    public function setGlobalBasename($file)
    {
        $this->driver->setGlobalBasename($file);
    }

    /**
     * @inheritDoc
     */
    public function setLocator(FileLocator $locator)
    {
        $this->driver->setLocator($locator);
    }
}