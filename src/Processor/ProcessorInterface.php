<?php
/**
 * Copyright 2017 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Naucon\Command\Processor;

use Naucon\Processor\ProcessorInterface as BaseProcessorInterface;
use Naucon\Processor\SupportAwareInterface as BaseSupportAwareInterface;

/**
 * Interface ProcessorInterface
 *
 * @package Naucon\Command\Processor
 * @author Sven Sanzenbacher
 */
interface ProcessorInterface extends BaseProcessorInterface, BaseSupportAwareInterface
{
    /**
     * @param object $action
     * @return bool
     */
    public function process($action);

    /**
     * @param object $action
     * @return bool
     */
    public function support($action);
}