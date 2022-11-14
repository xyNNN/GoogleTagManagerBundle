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
 * Interface GoogleTagManagerInterface
 *
 * @package Xynnn\GoogleTagManagerBundle\Service
 */
interface GoogleTagManagerInterface
{
    /**
     * @deprecated Use 'setData' or 'mergeData' methods
     */
    public function addData(string $key, mixed $value);

    public function setData(string $key, mixed $value): void;

    public function mergeData(string $key, mixed $value): void;

    public function enable(): void;

    public function disable(): void;

    public function isEnabled(): bool;

    public function getId(): string;

    public function setId(string $id): void;

    public function getData(): array;

    public function hasData(): bool;

    public function getPush(): array;

    public function addPush($value): void;

    public function setAdditionalParameters(string $additionalParameters): void;

    public function getAdditionalParameters(): string;
}
