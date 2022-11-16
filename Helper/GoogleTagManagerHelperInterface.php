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

use Symfony\Component\Templating\Helper\HelperInterface;

/**
 * Interface GoogleTagManagerHelperInterface
 *
 * @package Xynnn\GoogleTagManagerBundle\Helper
 */
interface GoogleTagManagerHelperInterface extends HelperInterface
{
    public function enable(): void;

    public function disable(): void;

    public function isEnabled(): bool;

    public function getId(): string;

    public function setId(string $id): void;

    public function getData(): array;

    public function hasData(): bool;

    public function getPush(): array;

    public function setAdditionalParameters(string $additionalParameters): void;

    public function getAdditionalParameters(): string;
}
