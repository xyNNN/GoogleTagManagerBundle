<?php
/*
 * This file is part of the GoogleTagManagerBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\GoogleTagManagerBundle\Tests\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class YamlGoogleTagManagerExtensionTest
 *
 * @package Xynnn\GoogleTagManagerBundle\Tests\DependencyInjection
 */
class YamlGoogleTagManagerExtensionTest extends AbstractGoogleTagManagerExtensionTest
{
    const FILE_TYPE = '.yml';

    /**
     * @param ContainerBuilder $container
     * @param                  $resource
     */
    protected function loadConfiguration(ContainerBuilder $container, $resource)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/Fixtures/Yaml/'));
        $loader->load($resource . self::FILE_TYPE);
    }
}