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
use Naucon\Command\CommandHydrator;

/**
 * Class CommandHydratorTest
 *
 * @package Naucon\Command\Tests
 * @author Sven Sanzenbacher
 */
class CommandHydratorTest extends \PHPUnit_Framework_TestCase
{
    public function testInit()
    {
        $hydrator = new CommandHydrator();

        $this->assertInstanceOf(CommandHydrator::class, $hydrator);
    }

    public function testPopulate()
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject|CommandInterface   $command
         */
        $command = $this->getMock(CommandInterface::class);

        $hydrator = new CommandHydrator();

        $hydrator->hydrate($command);
    }
}

