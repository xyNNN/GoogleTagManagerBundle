<?php
/*
 * This file is part of the GoogleTagManagerBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\GoogleTagManagerBundle\Twig;

use Symfony\Component\Templating\Helper\HelperInterface;
use Twig_Extension;
use Xynnn\GoogleTagManagerBundle\Helper\GoogleTagManagerHelper;
use Xynnn\GoogleTagManagerBundle\Helper\GoogleTagManagerHelperInterface;

/**
 * Class GoogleTagManagerExtension
 *
 * @package Xynnn\GoogleTagManagerBundle\Extension
 */
class GoogleTagManagerExtension extends Twig_Extension
{
    const AREA_FULL = 'full';
    const AREA_HEAD = 'head';
    const AREA_BODY = 'body';

    /**
     * @var GoogleTagManagerHelperInterface
     */
    private $helper;

    /**
     * @param GoogleTagManagerHelperInterface $helper
     */
    public function __construct(GoogleTagManagerHelperInterface $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('google_tag_manager', array($this, 'render'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            )),
            new \Twig_SimpleFunction('google_tag_manager_body', array($this, 'renderBody'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            )),
            new \Twig_SimpleFunction('google_tag_manager_head', array($this, 'renderHead'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            )),
        );
    }

    /**
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function render(\Twig_Environment $twig)
    {
        return $this->getRenderedTemplate($twig, self::AREA_FULL);
    }

    /**
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function renderHead(\Twig_Environment $twig)
    {
        return $this->getRenderedTemplate($twig, self::AREA_HEAD);
    }

    /**
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function renderBody(\Twig_Environment $twig)
    {
        return $this->getRenderedTemplate($twig, self::AREA_BODY);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'google_tag_manager';
    }

    /**
     * @param $area
     * @return string
     */
    private function getTemplate($area)
    {
        switch ($area) {
            case self::AREA_HEAD:
                return 'tagmanager_head';
            case self::AREA_BODY:
                return 'tagmanager_body';
            case self::AREA_FULL:
            default:
                return 'tagmanager';
        }
    }

    /**
     * @param \Twig_Environment $twig
     * @param $area
     * @return string
     */
    private function getRenderedTemplate(\Twig_Environment $twig, $area)
    {
        if (!$this->helper->isEnabled()) {
            return false;
        }

        return $twig->render(
            'GoogleTagManagerBundle::' . $this->getTemplate($area) . '.html.twig', array(
                'id' => $this->helper->getId(),
                'data' => $this->helper->hasData() ? $this->helper->getData() : null
            )
        );
    }
}
