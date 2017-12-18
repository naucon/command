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
use Naucon\Command\CommandLocator;
use Naucon\Command\Tests\Action\BarAction;
use Naucon\Command\Tests\Action\FooAction;
use Naucon\Command\Tests\Action\ResolveAction;
use Naucon\Command\Tests\Request\ResolveRequest;

class CommandLocatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array|CommandInterface[]
     */
    protected $commands = [];

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->commands[] = new BarAction();
        $this->commands[] = new ResolveAction();
        $this->commands[] = new FooAction();
    }


    public function testInit()
    {
        $locator = new CommandLocator();

        $this->assertInstanceOf(CommandLocator::class, $locator);
    }

    public function testLocate()
    {
        $commands = $this->commands;

        $request = new ResolveRequest();

        $locator = new CommandLocator();
        $command = $locator->locate($commands, $request);

        $this->assertInstanceOf(ResolveAction::class, $command);
    }

    public function testLocateWithNotSupportedRequest()
    {
        $commands = $this->commands;
        $request = new \stdClass();

        $locator = new CommandLocator();
        $command = $locator->locate($commands, $request);

        $this->assertFalse($command);
    }
}
