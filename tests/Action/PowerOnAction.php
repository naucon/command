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
use Naucon\Command\Tests\Request\PowerOnRequest;

/**
 * Class PowerOnAction
 *
 * @package Naucon\Command\Tests\Action
 * @author Sven Sanzenbacher
 */
class PowerOnAction implements CommandInterface
{
    /**
     * resolve something
     *
     * @param PowerOnRequest $request
     * @return mixed response
     */
    public function execute($request)
    {
        $light = $request->getLight();

        $light->setStatus($light::STATUS_ON);

        return true;
    }

    /**
     * @param PowerOnRequest $request
     * @return bool
     */
    public function support($request)
    {
        return $request instanceof PowerOnRequest;
    }

}