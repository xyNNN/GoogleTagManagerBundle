<?php
/*
 * This file is part of the GoogleTagManagerBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\GoogleTagManagerBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Xynnn\GoogleTagManagerBundle\Service\GoogleTagManager;

/**
 * Class GoogleTagManagerTest
 *
 * @package Xynnn\GoogleTagManagerBundle\Tests\Service
 */
class GoogleTagManagerTest extends TestCase
{
    public function testEnabledConfiguration()
    {
        $id = 'GTM-123456';

        $service = new GoogleTagManager(true, $id);

        $this->assertTrue($service->isEnabled());
        $this->assertSame('GTM-123456', $service->getId());
    }

    public function testDisabledConfiguration()
    {
        $id = 'GTM-123456';

        $service = new GoogleTagManager(false, $id);

        $this->assertFalse($service->isEnabled());
        $this->assertSame('GTM-123456', $service->getId());
    }

    public function testDataLayer()
    {
        $id = 'GTM-123456';

        $service = new GoogleTagManager(true, $id);
        $service->addData('example', 'value');

        $this->assertTrue($service->hasData());
        $this->assertArrayHasKey('example', $service->getData());
    }
}