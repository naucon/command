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

use Naucon\Command\Processor\ProcessorInterface;
use Naucon\Processor\ProcessorChain;

/**
 * Class CommandHydrator
 *
 * helps to inject data or instances into commands
 *
 * @package Naucon\Command
 * @author Sven Sanzenbacher
 */
class CommandHydrator
{
    /**
     * @var ProcessorChain
     */
    protected $processorChain;

    /**
     * Constructor
     *
     * @param ProcessorChain $processorChain
     */
    public function __construct(ProcessorChain $processorChain = null)
    {
        if ($processorChain === null) {
            $processorChain = new ProcessorChain();
        }
        $this->processorChain = $processorChain;
    }


    /**
     * @param ProcessorInterface $processor
     * @param int       $priority
     */
    public function addProcessor(ProcessorInterface $processor, $priority = 0)
    {
        $this->processorChain->addProcessor($processor, $priority);
    }

    /**
     * @param CommandInterface $command
     * @return bool
     */
    public function hydrate(CommandInterface $command)
    {
        $result = $this->processorChain->process($command);

        return $result;
    }
}