<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command\Tests\Model;

/**
 * Class Light
 *
 * @package Naucon\Command\Tests\Model
 * @author Sven Sanzenbacher
 */
class Light
{
    const STATUS_ON     = 'on';
    const STATUS_OFF    = 'off';

    /**
     * @var string
     */
    protected $status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->status = Light::STATUS_OFF;
    }


    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}