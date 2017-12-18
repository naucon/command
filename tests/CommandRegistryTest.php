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

use Naucon\Command\CommandRegistry;
use Naucon\Command\Tests\Action\BarAction;
use Naucon\Command\Tests\Action\FooAction;
use Naucon\Command\Tests\Action\ResolveAction;

class CommandRegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param   array   $expectedRegistry
     * @dataProvider registerProvider
     */
    public function testRegister($expectedRegistry)
    {
        $registry = new CommandRegistry();

        foreach ($expectedRegistry as $name => $entry) {
            $registry->register($name, $entry);
        }

        $this->assertEquals($expectedRegistry, $registry->all());
    }

    /**
     * @param   array   $expectedRegistry
     * @dataProvider registerProvider
     */
    public function testHas($expectedRegistry)
    {
        $registry = new CommandRegistry();

        foreach ($expectedRegistry as $name => $entry) {
            $registry->register($name, $entry);
        }

        $this->assertFalse($registry->has('missing'));

        foreach ($expectedRegistry as $name => $entry) {
            $this->assertTrue($registry->has($name));
        }
    }

    /**
     * @param   array   $expectedRegistry
     * @dataProvider registerProvider
     */
    public function testGet($expectedRegistry)
    {
        $registry = new CommandRegistry();

        foreach ($expectedRegistry as $name => $entry) {
            $registry->register($name, $entry);
        }

        $this->assertNull($registry->get('missing'));

        foreach ($expectedRegistry as $name => $entry) {
            $this->assertEquals($entry, $registry->get($name));
        }
    }

    /**
     * @param   array   $expectedRegistry
     * @dataProvider registerProvider
     */
    public function testCount($expectedRegistry)
    {
        $registry = new CommandRegistry();

        foreach ($expectedRegistry as $name => $entry) {
            $registry->register($name, $entry);
        }

        $this->assertCount(count($expectedRegistry), $registry);
    }

    /**
     * @param   array   $expectedRegistry
     * @param   array   $expectedUnregister
     * @dataProvider unregisterProvider
     */
    public function testUnregister($expectedRegistry, $expectedUnregister)
    {
        $registry = new CommandRegistry();

        foreach ($expectedRegistry as $name => $entry) {
            $registry->register($name, $entry);
        }

        // check that types to unregistered are present before unregister
        foreach ($expectedUnregister as $name) {
            $this->assertTrue($registry->has($name));
        }

        foreach ($expectedUnregister as $name) {
            $registry->unregister($name);
        }

        foreach ($expectedUnregister as $name) {
            $this->assertFalse($registry->has($name));
        }
    }

    public function registerProvider()
    {
        return [
            [
                [
                    'foo' => new FooAction(),
                    'resolve' => new ResolveAction(),
                    'bar' => new BarAction(),
                ]
            ]
        ];
    }

    public function unregisterProvider()
    {
        return [
            [
                [
                    'foo' => new FooAction(),
                    'resolve' => new ResolveAction(),
                    'bar' => new BarAction(),
                ],
                [
                    'resolve',
                ]
            ]
        ];
    }
}
