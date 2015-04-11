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
class GoogleTagManager
{
    /** @var bool $enabled */
    private $enabled;

    /** @var string $id */
    private $id;

    /** @var array $data */
    private $data;

    /**
     * @param $key
     * @param $value
     */
    public function addData($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool) $this->enabled;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function hasData()
    {
        return is_array($this->getData())
        && count($this->getData()) > 0;
    }

    /**
     * @param $enabled
     * @param $id
     */
    public function __construct($enabled, $id)
    {
        $this->enabled = $enabled;
        $this->id = $id;
        $this->data = array();
    }
}