<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command\Tests\Request;

use Naucon\Command\Tests\Model\Light;

/**
 * Class AbstractLightRequest
 *
 * @package Naucon\Command\Tests\Request
 * @author Sven Sanzenbacher
 */
abstract class AbstractLightRequest
{
    /**
     * @var Light
     */
    protected $light;

    /**
     * Constructor
     *
     * @param Light $light
     */
    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    /**
     * @return Light
     */
    public function getLight()
    {
        return $this->light;
    }

    /**
     * @param Light $light
     */
    public function setLight($light)
    {
        $this->light = $light;
    }
}