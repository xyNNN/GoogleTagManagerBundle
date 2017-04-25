<?php

namespace Xynnn\GoogleTagManagerBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

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
        $response = $event->getResponse();

        if (!$this->allowRender($event)) {
            return false;
        }

        // render the GTM Twig template
        $template = $this->twig
            ->getExtension('google_tag_manager')
            ->render($this->twig, \Xynnn\GoogleTagManagerBundle\Extension\GoogleTagManagerExtension::AREA_HEAD);

        // insert container immediately after opening <head>
        $content = preg_replace('/<head\b[^>]*>/', "$0" . $template, $response->getContent(), 1);

        // render the GTM Twig template for <noscript>
        $template = $this->twig
            ->getExtension('google_tag_manager')
            ->render($this->twig, \Xynnn\GoogleTagManagerBundle\Extension\GoogleTagManagerExtension::AREA_BODY);

        // insert container immediately after opening <body>
        $content = preg_replace('/<body\b[^>]*>/', "$0" . $template, $response->getContent(), 1);

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
