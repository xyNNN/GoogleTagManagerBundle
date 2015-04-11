<?php
/*
 * This file is part of the GoogleTagManagerBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\GoogleTagManagerBundle\Extension;

use Symfony\Component\Templating\Helper\HelperInterface;
use Twig_Extension;
use Xynnn\GoogleTagManagerBundle\Helper\GoogleTagManagerHelper;

/**
 * Class GoogleTagManagerExtension
 *
 * @package Xynnn\GoogleTagManagerBundle\Extension
 */
class GoogleTagManagerExtension extends Twig_Extension
{
    /** @var HelperInterface $helper */
    private $helper;

    /**
     * @return HelperInterface
     */
    private function getHelper()
    {
        return $this->helper;
    }

    /**
     * @param HelperInterface $helper
     */
    public function __construct(HelperInterface $helper)
    {
        $this->helper = $helper;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('google_tag_manager', array($this, 'render'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            ))
        );
    }

    /**
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function render(\Twig_Environment $twig)
    {
        /** @var GoogleTagManagerHelper $helper */
        $helper = $this->getHelper();

        if (!$helper->isEnabled()) {
           return false;
        }

        return $twig->render(
            'GoogleTagManagerBundle::tagmanager.html.twig', array(
                'id' => $helper->getId(),
                'data' => $helper->hasData() ? $helper->getData() : null
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'google_tag_manager';
    }
}
