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
use Naucon\Command\Response\HttpRedirect;
use Naucon\Command\Tests\Request\HttpRedirectRequest;

/**
 * Class HttpRedirectAction
 *
 * @package Naucon\Action\Tests
 * @author Sven Sanzenbacher
 */
class HttpRedirectAction implements CommandInterface
{
    /**
     * resolve something
     *
     * @param HttpRedirectRequest $request
     * @throws HttpRedirect
     */
    public function execute($request)
    {
        $targetUrl = $request->getTargetUrl();

        throw new HttpRedirect($targetUrl);
    }

    /**
     * @param HttpRedirectRequest $request
     * @return bool
     */
    public function support($request)
    {
        return $request instanceof HttpRedirectRequest;
    }

}