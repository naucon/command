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

use Naucon\Command\CommandInterface;
use Naucon\Command\CommandManager;
use Naucon\Command\CommandManagerInterface;
use Naucon\Command\CommandRegistry;
use Naucon\Command\Response\HttpRedirect;
use Naucon\Command\Response\HttpResponse;
use Naucon\Command\Response\ResponseInterface;
use Naucon\Command\Tests\Action\BarAction;
use Naucon\Command\Tests\Action\ExceptionAction;
use Naucon\Command\Tests\Action\FooAction;
use Naucon\Command\Tests\Action\HttpRedirectAction;
use Naucon\Command\Tests\Action\HttpResponseAction;
use Naucon\Command\Tests\Action\LogicExceptionAction;
use Naucon\Command\Tests\Request\BarRequest;
use Naucon\Command\Tests\Request\ExceptionRequest;
use Naucon\Command\Tests\Request\HttpRedirectRequest;
use Naucon\Command\Tests\Request\HttpResponseRequest;
use Naucon\Command\Tests\Request\ResolveRequest;

/**
 * Class CommandManagerTest
 *
 * @package Naucon\Command\Tests
 * @author Sven Sanzenbacher
 */
class CommandManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommandRegistry
     */
    protected $registry;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $command = $this->getCommandMock(true, true);

        $this->registry = new CommandRegistry();
        $this->registry->register('foo', $command);
    }

    public function testInit()
    {
        $registry = $this->registry;

        $manager = new CommandManager($registry);

        $this->assertInstanceOf(CommandManagerInterface::class, $manager);
    }

    public function testRegister()
    {
        $name = 'foo';
        $command = $this->getCommandMock(true, true);

        $registry = $this->getRegistryMock();
        $registry->expects($this->once())
            ->method('register')
            ->with($this->equalTo($name), $command);
        
        $manager = new CommandManager($registry);
        $manager->register($name, $command);

        $this->assertInstanceOf(CommandManager::class, $manager);
    }

    public function testExecute()
    {
        $registry = $this->registry;

        $manager = new CommandManager($registry);

        $response = $manager->execute(new ResolveRequest());

        $this->assertTrue($response);
    }

    public function testExecuteWithHydration()
    {
        $registry = new CommandRegistry();
        $request  = new BarRequest();
        $manager  = new CommandManager($registry);

        $expectedResponse = 'foobar';

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject|BarAction  $action
         */
        $action = $this->getMockBuilder(BarAction::class)
            ->getMock();

        $action->expects($this->once())
            ->method('setCommandManager')
            ->with($this->equalTo($manager));

        $action->expects($this->once())
            ->method('support')
            ->with($this->equalTo($request))
            ->willReturn(true);

        $action->expects($this->once())
            ->method('execute')
            ->with($this->equalTo($request))
            ->willReturn($expectedResponse);

        $registry->register('bar', $action);

        $response = $manager->execute($request);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testExecuteWithSubRequest()
    {
        $registry = new CommandRegistry();
        $request  = new BarRequest();
        $manager  = new CommandManager($registry);

        $expectedResponse = 'foobar';

        $registry->register('foo', new FooAction());
        $registry->register('bar', new BarAction());

        $response = $manager->execute($request);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testExecuteWithResponseException()
    {
        $registry = new CommandRegistry();
        $manager  = new CommandManager($registry);

        $registry->register('http_response', new HttpResponseAction());
        $registry->register('http_redirect', new HttpRedirectAction());

        /**
         * @var HttpResponse    $response
         */
        $request  = new HttpResponseRequest('foo');
        $response = $manager->execute($request);

        $this->assertInstanceOf(HttpResponse::class, $response);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('foo', $response->getContent());

        /**
         * @var HttpRedirect    $response
         */
        $request  = new HttpRedirectRequest('bar');
        $response = $manager->execute($request);

        $this->assertInstanceOf(HttpRedirect::class, $response);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('bar', $response->getUrl());
    }

    /**
     * @expectedException \Exception
     */
    public function testExecuteWithException()
    {
        $registry = new CommandRegistry();
        $manager  = new CommandManager($registry);

        $registry->register('exception', new ExceptionAction());

        $request  = new ExceptionRequest();
        $manager->execute($request);
    }

    /**
     * @expectedException \LogicException
     */
    public function testExecuteWithLogicException()
    {
        $registry = new CommandRegistry();
        $manager  = new CommandManager($registry);

        $registry->register('exception', new LogicExceptionAction());

        $request  = new ExceptionRequest();
        $manager->execute($request);
    }

    /**
     * @param bool  $support
     * @param mixed $result
     * @return CommandInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getCommandMock($support = false, $result)
    {
        $mock = $this->getMockBuilder(CommandInterface::class)
            ->getMock();

        $mock->expects($this->any())
            ->method('support')
            ->willReturn($support);

        $mock->expects($this->any())
            ->method('execute')
            ->willReturn($result);

        return $mock;
    }

    /**
     * @return CommandRegistry|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getRegistryMock()
    {
        $mock = $this->getMockBuilder(CommandRegistry::class)
            ->getMock();

        return $mock;
    }
}
