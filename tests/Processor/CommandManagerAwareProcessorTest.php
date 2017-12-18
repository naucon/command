<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Command\Tests\Processor;

use Naucon\Command\CommandManagerInterface;
use Naucon\Command\Processor\CommandManagerAwareProcessor;
use Naucon\Command\Processor\ProcessorInterface;
use Naucon\Command\Tests\Action\BarAction;
use Naucon\Command\Tests\Action\FooAction;

/**
 * Class CommandManagerAwareProcessorTest
 *
 * @package Naucon\Command\Tests\Processor
 * @author Sven Sanzenbacher
 */
class CommandManagerAwareProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommandManagerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $commandManager;

    protected function setUp()
    {
        parent::setUp();

        $this->commandManager = $this->getMockBuilder(CommandManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testInit()
    {
        $commandManager = $this->commandManager;

        $processor = new CommandManagerAwareProcessor($commandManager);

        $this->assertInstanceOf(ProcessorInterface::class, $processor);
    }

    public function testProcess()
    {
        $commandManager = $this->commandManager;

        $processor = new CommandManagerAwareProcessor($commandManager);

        $action = $this->getMockBuilder(BarAction::class)->getMock();
        $action->expects($this->once())
            ->method('setCommandManager')
            ->with($this->equalTo($commandManager));

        $actualResult = $processor->process($action);

        $this->assertTrue($actualResult);
    }

    public function testSupport()
    {
        $commandManager = $this->commandManager;

        $processor = new CommandManagerAwareProcessor($commandManager);

        $goodAction = new BarAction();
        $actualResult = $processor->support($goodAction);

        $this->assertTrue($actualResult);

        $badAction = new FooAction();
        $actualResult = $processor->support($badAction);

        $this->assertFalse($actualResult);
    }
}
