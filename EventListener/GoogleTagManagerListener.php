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

    private $appendTo;

    public function __construct($serviceContainer, $appendTo)
    {
        $this->twig = $serviceContainer->get('twig');
        $this->appendTo = $appendTo;
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
        $appendTo = strtolower($this->appendTo);

        // not configured to append automatically
        if ( ! in_array($appendTo, ['top', 'bottom'])) {
            return false;
        }

        // only append to HTML responses
        if ( ! in_array($contentType, ['text/html', null])) {
            return false;
        }

        // render the GTM Twig template
        $template = $this->twig
            ->getExtension('google_tag_manager')
            ->render($this->twig);

        // decide where to append
        switch ($appendTo)
        {
            case 'top':
                $content = $this->appendTop($template, $response->getContent());
                break;

            case 'bottom':
            default:
                $content = $this->appendBottom($template, $response->getContent());
                break;
        }

        // update the response
        $response->setContent($content);

        return true;
    }

    private function appendTop($snippet, $content)
    {
        return preg_replace('/<body\b[^>]*>/', "$0" . $snippet, $content, 1);
    }

    private function appendBottom($snippet, $content)
    {
        return str_replace('</body>', $snippet . '</body>', $content);
    }
}
