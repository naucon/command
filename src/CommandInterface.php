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
 * Interface ActionInterface
 *
 * @package Naucon\Command
 * @author Sven Sanzenbacher
 */
interface CommandInterface
{
    /**
     * @param mixed $request
     * @return mixed response
     */
    public function execute($request);

    /**
     *
     * @param mixed $request
     * @return bool     returns true if request is support, else false
     */
    public function support($request);
}