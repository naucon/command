<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command\Tests\Action;

use Naucon\Command\CommandInterface;
use Naucon\Command\Tests\Request\FooRequest;

/**
 * Class FooAction
 *
 * @package Naucon\Action\Tests
 * @author Sven Sanzenbacher
 */
class FooAction implements CommandInterface
{
    /**
     * resolve something
     *
     * @param FooRequest $request
     * @return mixed response
     */
    public function execute($request)
    {
        return 'foo';
    }

    /**
     * @param FooRequest $request
     * @return bool
     */
    public function support($request)
    {
        return $request instanceof FooRequest;
    }

}