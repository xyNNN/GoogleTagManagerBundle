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

/**
 * Class GoogleTagManager
 *
 * @package Xynnn\GoogleTagManagerBundle\Service
 */
class GoogleTagManager implements GoogleTagManagerInterface
{
    private bool $enabled;

    private string $id;

    private array $data = array();

    private array $push = array();

    private string $additionalParameters;

    public function __construct(bool $enabled, string $id)
    {
        $this->enabled = $enabled;
        $this->id = $id;
    }

    public function addData(string $key, mixed $value)
    {
        $this->setData($key, $value);
    }

    public function setData(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function mergeData(string $key, mixed $value): void
    {
        $merge = array();
        if (array_key_exists($key, $this->data)) {
            $merge = $this->data[$key];
        }

        $this->setData($key, array_merge_recursive($merge, $value));
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function addPush($value): void
    {
        $this->push[] = $value;
    }

    public function getPush(): array
    {
        return $this->push;
    }

    public function hasData(): bool
    {
        return is_array($this->getData())
        && count($this->getData()) > 0;
    }

    public function reset(): void
    {
        $this->data = array();
        $this->push = array();
    }

    public function setAdditionalParameters($additionalParameters): void
    {
        $this->additionalParameters = $additionalParameters;
    }

    public function getAdditionalParameters(): string
    {
        return $this->additionalParameters;
    }
}
