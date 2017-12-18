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

/**
 * Interface CommandManagerAwareInterface
 *
 * @package Naucon\Command
 * @author Sven Sanzenbacher
 */
interface CommandManagerAwareInterface
{
    /**
     * @param CommandManagerInterface  $commandManager
     */
    public function setCommandManager(CommandManagerInterface $commandManager);
}