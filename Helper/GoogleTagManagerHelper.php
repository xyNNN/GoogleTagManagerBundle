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
    private GoogleTagManagerInterface $service;

    /**
     * @param GoogleTagManagerInterface $service
     */
    public function __construct(GoogleTagManagerInterface $service)
    {
        $this->service = $service;
    }

    public function enable(): void
    {
        $this->service->enable();
    }

    public function disable(): void
    {
        $this->service->disable();
    }

    public function isEnabled(): bool
    {
        return $this->service->isEnabled();
    }

    public function getId(): string
    {
        return $this->service->getId();
    }

    public function setId($id): void
    {
        $this->service->setId($id);
    }

    public function getData(): array
    {
        return $this->service->getData();
    }

    public function hasData(): bool
    {
        return $this->service->hasData();
    }

    public function getPush(): array
    {
        return $this->service->getPush();
    }

    public function getName(): string
    {
        return 'google_tag_manager';
    }

    public function setAdditionalParameters($additionalParameters): void
    {
        $this->service->setAdditionalParameters($additionalParameters);
    }

    public function getAdditionalParameters(): string
    {
        return $this->service->getAdditionalParameters();
    }
}
