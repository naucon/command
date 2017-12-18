<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command;

use Naucon\Registry\Registry;
use Naucon\Registry\RegistryInterface;

/**
 * Class CommandRegistry
 *
 * @package Naucon\Command
 * @author Sven Sanzenbacher
 */
class CommandRegistry implements \Countable
{
    /**
     * @var RegistryInterface
     */
    protected $internalRegistry;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->internalRegistry = new Registry();
    }

    /**
     * @param string $name entry name
     * @param CommandInterface $command
     * @return self
     */
    public function register($name, CommandInterface $command)
    {
        $this->internalRegistry->register($name, $command);

        return $this;
    }

    /**
     * @param string $name entry name
     * @return self
     */
    public function unregister($name)
    {
        $this->internalRegistry->unregister($name);

        return $this;
    }

    /**
     * @return array|CommandInterface[] returns all registered entries
     */
    public function all()
    {
        return $this->internalRegistry->all();
    }

    /**
     * @param string $name entry name
     * @return CommandInterface|null
     */
    public function get($name)
    {
        return $this->internalRegistry->get($name);
    }

    /**
     * @param string $name entry name
     * @return bool returns true if entry name is registered, else false
     */
    public function has($name)
    {
        return $this->internalRegistry->has($name);
    }

    /**
     * @return int how many entries are registered
     */
    public function count()
    {
        return $this->internalRegistry->count();
    }
}