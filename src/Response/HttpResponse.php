<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command\Response;

/**
 * Class HttpResponse
 *
 * @package Naucon\Command\Response
 * @author Sven Sanzenbacher
 */
class HttpResponse extends AbstractResponse
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var array|string[]
     */
    protected $headers;

    /**
     * Constructor
     *
     * @param   string          $content
     * @param   int             $statusCode
     * @param   array|string[]  $headers
     * @param   \Throwable       $previous
     */
    public function __construct($content, $statusCode = 200, array $headers = array(), $previous = null)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;

        if ($previous !== null) {
            parent::__construct($previous->getMessage(), $previous->getCode(), $previous);
        }
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
