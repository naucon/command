<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command\Tests\Response;

use Naucon\Command\Response\AbstractResponse;
use Naucon\Command\Response\HttpRedirect;
use Naucon\Command\Response\HttpResponse;
use Naucon\Command\Response\ResponseInterface;

class HttpRedirectTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $response = new HttpRedirect('http://example.org');

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertInstanceOf(AbstractResponse::class, $response);
        $this->assertInstanceOf(HttpResponse::class, $response);
    }
}