<?php

namespace Xynnn\GoogleTagManagerBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Xynnn\GoogleTagManagerBundle\Twig\GoogleTagManagerExtension;

/**
 * Class GoogleTagManagerListener
 *
 * @package Xynnn\GoogleTagManagerBundle\EventListener
 */
class GoogleTagManagerListener
{

    private $twig;

    /**
     * @var bool
     */
    private $autoAppend;

    /**
     * GoogleTagManagerListener constructor.
     * @param $serviceContainer
     * @param $autoAppend
     */
    public function __construct($serviceContainer, $autoAppend)
    {
        $this->twig = $serviceContainer->get('twig');
        $this->autoAppend = (bool)$autoAppend;
    }

    /**
     * @param FilterResponseEvent $event
     *
     * @return bool
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$this->allowRender($event)) {
            return false;
        }

        $response = $event->getResponse();

        // Render the GTM Twig template for after <head>
        $templateHead = $this->twig
            ->getExtension('google_tag_manager')
            ->renderHead($this->twig);

        // render the GTM Twig template for after <body>
        $templateBody = $this->twig
            ->getExtension('google_tag_manager')
            ->renderBody($this->twig);

        // Insert container immediately after opening <head> or <body>
        $content = preg_replace(array(
            '/<head\b[^>]*>/',
            '/<body\b[^>]*>/'
        ), array(
            "$0" . $templateHead,
            "$0" . $templateBody
        ), $response->getContent(), 1);

        // update the response
        $response->setContent($content);

        return true;
    }

    /**
     * @param FilterResponseEvent $event
     * @return bool
     */
    private function allowRender(FilterResponseEvent $event)
    {
        // not configured to append automatically
        if (!$this->autoAppend) {
            return false;
        }

        // only append to HTML responses
        if (!in_array($event->getResponse()->headers->get('content-type'), ['text/html', null])) {
            return false;
        }

        // only append to master request
        if (!$event->isMasterRequest()) {
            return false;
        }

        return true;
    }
}
