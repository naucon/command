<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command\Processor;

use Naucon\Command\CommandManagerAwareInterface;
use Naucon\Command\CommandManagerInterface;

/**
 * Class CommandManagerAwareProcessor
 *
 * @package Naucon\Command\Processor
 * @author Sven Sanzenbacher
 */
class CommandManagerAwareProcessor implements ProcessorInterface
{
    /**
     * @var CommandManagerInterface
     */
    protected $commandManager;

    /**
     * Constructor
     *
     * @param CommandManagerInterface $commandManager
     */
    public function __construct(CommandManagerInterface $commandManager)
    {
        $this->commandManager = $commandManager;
    }


    /**
     * @param object|CommandManagerAwareInterface $action
     * @return bool
     */
    public function process($action)
    {
        $action->setCommandManager($this->commandManager);

        return true;
    }

    /**
     * @param object|CommandManagerAwareInterface $action
     * @return bool
     */
    public function support($action)
    {
        return $action instanceof CommandManagerAwareInterface;
    }
}