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
use Naucon\Command\Response\HttpResponse;
use Naucon\Command\Response\ResponseInterface;

class HttpResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $content = 'my content';

        $response = new HttpResponse($content);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertInstanceOf(AbstractResponse::class, $response);

        $this->assertEquals($content, $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
    }
}