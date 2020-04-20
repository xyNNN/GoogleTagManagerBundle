<?php
/*
 * This file is part of the GoogleTagManagerBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\GoogleTagManagerBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Xynnn\GoogleTagManagerBundle\Service\GoogleTagManagerInterface;

/**
 * Class GoogleTagManagerHelper
 *
 * @package Xynnn\GoogleTagManagerBundle\Helper
 */
class GoogleTagManagerHelper extends Helper implements GoogleTagManagerHelperInterface
{
    /**
     * @var GoogleTagManagerInterface
     */
    private $service;

    /**
     * @param GoogleTagManagerInterface $service
     */
    public function __construct(GoogleTagManagerInterface $service)
    {
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabledStatus($status)
    {
        $this->service->setEnabledStatus($status);
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->service->isEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->service->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->service->setId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->service->getData();
    }

    /**
     * {@inheritdoc}
     */
    public function hasData()
    {
        return $this->service->hasData();
    }

    /**
     * {@inheritdoc}
     */
    public function getPush()
    {
        return $this->service->getPush();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'google_tag_manager';
    }
}
