<?php
/*
 * This file is part of the GoogleTagManagerBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\GoogleTagManagerBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class GoogleTagManagerFactory
 *
 * @package Xynnn\GoogleTagManagerBundle\Service
 */
class GoogleTagManagerFactory
{
    private ContainerInterface $container;

    public function setContainer(ContainerInterface $container): ContainerInterface
    {
        return $this->container = $container;
    }

    public function create(): GoogleTagManagerInterface
    {
        $container = $this->container;

        $enabled = $container->getParameter('google_tag_manager.enabled');
        $id = $container->getParameter('google_tag_manager.id');
        $additionalParameters = $container->getParameter('google_tag_manager.additionalParameters');

        $service = new GoogleTagManager($enabled, $id);

        if ($additionalParameters)
        {
            $service->setAdditionalParameters($container->getParameter('google_tag_manager.additionalParameters'));
        }

        return $service;
    }
}
