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
    /**
     * @var bool
     */
    private $enabled;

    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $data = array();

    /**
     * @param $enabled
     * @param $id
     */
    public function __construct($enabled, $id)
    {
        $this->enabled = (bool)$enabled;
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function addData($key, $value)
    {
        $this->setData($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function mergeData($key, $value)
    {
        $merge = [];
        if (array_key_exists($key, $this->data)) {
            $merge = $this->data[$key];
        }

        $this->setData($key, array_merge_recursive($merge, $value));
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function hasData()
    {
        return is_array($this->getData())
        && count($this->getData()) > 0;
    }
}
