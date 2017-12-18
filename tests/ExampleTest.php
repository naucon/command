<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command\Tests;

use Naucon\Command\CommandManager;
use Naucon\Command\Tests\Action\PowerOnAction;
use Naucon\Command\Tests\Action\PowerOffAction;
use Naucon\Command\Tests\Request\PowerOnRequest;
use Naucon\Command\Tests\Request\PowerOffRequest;
use Naucon\Command\Tests\Model\Light;
use Naucon\Command\Tests\Action\FooAction;
use Naucon\Command\Tests\Action\BarAction;
use Naucon\Command\Tests\Request\BarRequest;

/**
 * Class ExampleTest
 *
 * @package Naucon\Command\Tests
 * @author Sven Sanzenbacher
 */
class ExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleExample()
    {
        $manager = new CommandManager();
        $manager->register('power_on', new PowerOnAction());
        $manager->register('power_off', new PowerOffAction());

        $light = new Light();

        $this->assertEquals(Light::STATUS_OFF, $light->getStatus());

        $request = new PowerOnRequest($light);
        $response = $manager->execute($request);

        $this->assertTrue($response);
        $this->assertEquals(Light::STATUS_ON, $light->getStatus());

        $request = new PowerOffRequest($light);
        $response = $manager->execute($request);

        $this->assertTrue($response);
        $this->assertEquals(Light::STATUS_OFF, $light->getStatus());
    }

    public function testExampleWithSubRequest()
    {
        $manager = new CommandManager();
        // returns 'foo'
        $manager->register('foo', new FooAction());
        // executes and returns FooAction and add 'bar'
        $manager->register('bar', new BarAction());

        $request = new BarRequest();
        $response = $manager->execute($request);

        $this->assertEquals('foobar', $response);
    }
}