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

/**
 * Class HttpRedirectRequest
 *
 * @package Naucon\Command\Tests\Request
 * @author Sven Sanzenbacher
 */
class HttpRedirectRequest
{
    /**
     * @var string
     */
    protected $targetUrl;

    /**
     * Constructor
     *
     * @param string $targetUrl
     */
    public function __construct($targetUrl)
    {
        $this->targetUrl = $targetUrl;
    }

    /**
     * @return string
     */
    public function getTargetUrl()
    {
        return $this->targetUrl;
    }

    /**
     * @param string $targetUrl
     */
    public function setTargetUrl($targetUrl)
    {
        $this->targetUrl = $targetUrl;
    }
}