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

use Naucon\Command\Exception as Exception;

/**
 * Class HttpRedirect
 *
 * @package Naucon\Command\Response
 * @author Sven Sanzenbacher
 */
class HttpRedirect extends HttpResponse
{
    /**
     * @var string
     */
    protected $url;


    /**
     * Constructor
     *
     * @param   string              $url
     * @param   int                 $statusCode
     * @param   array|string[]      $headers
     * @param   \Throwable          $previous
     */
    public function __construct($url, $statusCode = 302, array $headers = array(), $previous = null)
    {
        $this->url = $url;

        $headers['Location'] = $url;

        parent::__construct($this->prepareContent($url), $statusCode, $headers, $previous);
    }


    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return string
     */
    protected function prepareContent($url)
    {
        if (empty($url)) {
            throw new Exception\InvalidArgumentException('Cannot redirect to an empty URL.');
        }

        return sprintf('<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="1;url=%1$s" />

        <title>Redirecting to %1$s</title>
    </head>
    <body>
        Redirecting to %1$s.
    </body>
</html>', htmlspecialchars($url, ENT_QUOTES, 'UTF-8'));
    }
}
