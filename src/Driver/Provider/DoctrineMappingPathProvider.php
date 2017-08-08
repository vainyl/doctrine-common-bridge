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

namespace Vainyl\Doctrine\Common\Driver\Provider;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Core\Extension\ExtensionInterface;
use Vainyl\Doctrine\Common\DoctrineSettings;

/**
 * Class DoctrineMappingPathProvider
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DoctrineMappingPathProvider extends AbstractIdentifiable
{
    /**
     * @param DoctrineSettings $settings
     * @param \Traversable     $bundleStorage
     *
     * @return array
     */
    public function getPaths(DoctrineSettings $settings, \Traversable $bundleStorage): array
    {
        $paths = [];
        foreach ($settings->getExtraPaths() as $extraPath) {
            if (false === is_dir($extraPath['dir'])) {
                continue;
            }
            $paths[$extraPath['dir']] = $extraPath['prefix'];
        }
        /**
         * @var ExtensionInterface $bundle
         */
        foreach ($bundleStorage as $bundle) {
            $configDirectory = $bundle->getConfigDirectory();
            if (false === is_dir($configDirectory)) {
                continue;
            }
            $paths[$bundle->getConfigDirectory()] = $bundle->getNamespace();
        }

        return $paths;
    }
}