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
use Naucon\Command\CommandManagerAwareInterface;
use Naucon\Command\CommandManagerAwareTrait;
use Naucon\Command\Tests\Request\BarRequest;
use Naucon\Command\Tests\Request\FooRequest;

/**
 * Class BarAction
 *
 * @package Naucon\Action\Tests
 * @author Sven Sanzenbacher
 */
class BarAction implements CommandInterface, CommandManagerAwareInterface
{
    use CommandManagerAwareTrait;

    /**
     * resolve something
     *
     * @param BarRequest $request
     * @return mixed response
     */
    public function execute($request)
    {
        $request = new FooRequest();

        $response = $this->commandManager->execute($request);
        $response.= 'bar';

        return $response;
    }

    /**
     * @param BarRequest $request
     * @return bool
     */
    public function support($request)
    {
        return $request instanceof BarRequest;
    }

}