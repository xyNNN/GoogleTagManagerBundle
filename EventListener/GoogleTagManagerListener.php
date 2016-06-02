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

    private $autoAppend;

    public function __construct($serviceContainer, $autoAppend)
    {
        $this->twig = $serviceContainer->get('twig');
        $this->autoAppend = (bool) $autoAppend;
    }

    /**
     * @param FilterResponseEvent $event
     *
     * @return bool
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $contentType = $response->headers->get('content-type');

        // not configured to append automatically
        if ( ! $this->autoAppend) {
            return false;
        }

        // only append to HTML responses
        if ( ! in_array($contentType, ['text/html', null])) {
            return false;
        }

        // only append to master request
        if ( ! $event->isMasterRequest()) {
            return false;
        }

        // render the GTM Twig template
        $template = $this->twig
            ->getExtension('google_tag_manager')
            ->render($this->twig);

        // insert container immediately after opening <body>
        $content = preg_replace('/<body\b[^>]*>/', "$0" . $template, $response->getContent(), 1);

        // update the response
        $response->setContent($content);

        return true;
    }
}
