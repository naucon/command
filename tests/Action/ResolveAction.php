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
use Naucon\Command\Tests\Request\ResolveRequest;

/**
 * Class ResolveAction
 *
 * @package Naucon\Action\Tests
 * @author Sven Sanzenbacher
 */
class ResolveAction implements CommandInterface
{
    /**
     * resolve something
     *
     * @param ResolveRequest $request
     */
    public function execute($request)
    {

    }

    /**
     * @param ResolveRequest $request
     * @return bool
     */
    public function support($request)
    {
        return $request instanceof ResolveRequest;
    }

}