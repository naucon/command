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

use Naucon\Command\Exception\InvalidArgumentException;

/**
 * Interface CommandManagerInterface
 *
 * @package Naucon\Command
 * @author Sven Sanzenbacher
 */
interface CommandManagerInterface
{
    /**
     * execute requests
     *
     * @param mixed $request
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function execute($request);
}