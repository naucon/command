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
 * Class CommandLocator
 *
 * @package Naucon\Command
 * @author Sven Sanzenbacher
 */
class CommandLocator
{
    /**
     * locate supported command in registry
     *
     * @param array|CommandInterface[] $commands
     * @param mixed $request
     * @return bool|CommandInterface     returns first supported command, else false
     */
    public function locate(array $commands, $request)
    {
        foreach ($commands as $command) {
            if ($command->support($request)) {
                return $command;
            }
        }

        return false;
    }
}