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

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Xynnn\GoogleTagManagerBundle\Helper\GoogleTagManagerHelperInterface;

/**
 * Class GoogleTagManagerExtension
 *
 * @package Xynnn\GoogleTagManagerBundle\Extension
 */
class GoogleTagManagerExtension extends AbstractExtension
{
    const AREA_FULL = 'full';
    const AREA_HEAD = 'head';
    const AREA_BODY = 'body';
    const AREA_BODY_END = 'body_end';

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
            new TwigFunction('google_tag_manager', array($this, 'render'), array(
                'is_safe' => array('html'),
                'needs_environment' => true,
                'deprecated' => true,
            )),
            new TwigFunction('google_tag_manager_body', array($this, 'renderBody'), array(
                'is_safe' => array('html'),
                'needs_environment' => true,
            )),
            new TwigFunction('google_tag_manager_head', array($this, 'renderHead'), array(
                'is_safe' => array('html'),
                'needs_environment' => true,
            )),
            new TwigFunction('google_tag_manager_body_end', array($this, 'renderBodyEnd'), array(
                'is_safe' => array('html'),
                'needs_environment' => true,
            )),
        );
    }

    /**
     * @param Environment $twig
     *
     * @deprecated Use `renderHead` and `renderBody`
     *
     * @return string
     */
    public function render(Environment $twig)
    {
        return $this->getRenderedTemplate($twig, self::AREA_FULL);
    }

    /**
     * @param Environment $twig
     *
     * @return string
     */
    public function renderHead(Environment $twig)
    {
        return $this->getRenderedTemplate($twig, self::AREA_HEAD);
    }

    /**
     * @param Environment $twig
     *
     * @return string
     */
    public function renderBody(Environment $twig)
    {
        return $this->getRenderedTemplate($twig, self::AREA_BODY);
    }

    /**
     * @param Environment $twig
     *
     * @return string
     */
    public function renderBodyEnd(Environment $twig)
    {
        return $this->getRenderedTemplate($twig, self::AREA_BODY_END);
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
            case self::AREA_BODY_END:
                return 'tagmanager_body_end';
            case self::AREA_FULL:
            default:
                return 'tagmanager';
        }
    }

    /**
     * @param Environment $twig
     * @param $area
     * @return string
     */
    private function getRenderedTemplate(Environment $twig, $area)
    {
        if (!$this->helper->isEnabled()) {
            return '';
        }

        return $twig->render(
            '@GoogleTagManager/' . $this->getTemplate($area) . '.html.twig', array(
                'id' => $this->helper->getId(),
                'data' => $this->helper->hasData() ? $this->helper->getData() : null,
                'push' => $this->helper->getPush() ? $this->helper->getPush() : null,
            )
        );
    }
}
