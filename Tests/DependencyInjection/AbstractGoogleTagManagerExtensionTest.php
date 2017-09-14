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

use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Xynnn\GoogleTagManagerBundle\DependencyInjection\GoogleTagManagerExtension;

/**
 * Class AbstractGoogleTagManagerExtensionTest
 *
 * @package Xynnn\GoogleTagManagerBundle\Tests\DependencyInjection
 */
abstract class AbstractGoogleTagManagerExtensionTest extends PHPUnit_Framework_TestCase
{
    /** @var GoogleTagManagerExtension $extension */
    private $extension;

    /** @var ContainerBuilder $container */
    private $container;

    protected function setUp()
    {
        $this->extension = new GoogleTagManagerExtension();

        $this->container = new ContainerBuilder();
        $this->container->register('twig', $this->getMockBuilder('\Twig_Environment')->getMock());
        $this->container->registerExtension($this->extension);
    }

    /**
     * @param ContainerBuilder $container
     * @param                  $resource
     */
    abstract protected function loadConfiguration(ContainerBuilder $container, $resource);

    public function testWithoutConfiguration()
    {
        // An extension is only loaded in the container if a configuration is provided for it.
        // Then, we need to explicitely load it.
        $this->container->loadFromExtension($this->extension->getAlias());
        $this->container->compile();

        $this->assertFalse($this->container->hasParameter('google_tag_manager'));
    }

    public function testDisabledConfiguration()
    {
        $this->loadConfiguration($this->container, 'disabled');
        $this->container->compile();

        $this->assertFalse($this->container->getParameter('google_tag_manager.enabled'));
    }

    public function testEnabledConfiguration()
    {
        $this->loadConfiguration($this->container, 'enabled');
        $this->container->compile();

        $this->assertTrue($this->container->hasParameter('google_tag_manager.enabled'));
    }
}