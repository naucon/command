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
use Naucon\Command\Response\HttpResponse;
use Naucon\Command\Tests\Request\HttpResponseRequest;

/**
 * Class HttpResponseAction
 *
 * @package Naucon\Action\Tests
 * @author Sven Sanzenbacher
 */
class HttpResponseAction implements CommandInterface
{
    /**
     * resolve something
     *
     * @param HttpResponseRequest $request
     * @throws HttpResponse
     */
    public function execute($request)
    {
        $content = $request->getContent();

        throw new HttpResponse($content);
    }

    /**
     * @param HttpResponseRequest $request
     * @return bool
     */
    public function support($request)
    {
        return $request instanceof HttpResponseRequest;
    }

}