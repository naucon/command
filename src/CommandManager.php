<?php
/*
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Command;

use Naucon\Command\Exception\InvalidArgumentException;
use Naucon\Command\Processor\CommandManagerAwareProcessor;
use Naucon\Command\Processor\ProcessorInterface;
use Naucon\Command\Response\ResponseInterface;

/**
 * Class CommandManager
 *
 * @package     Naucon\Command
 * @author      Sven Sanzenbacher
 */
class CommandManager implements CommandManagerInterface
{
    /**
     * @var CommandRegistry
     */
    protected $registry;

    /**
     * @var CommandLocator
     */
    protected $locator;

    /**
     * @var CommandHydrator
     */
    protected $hydrator;


    /**
     * Constructor
     *
     * @param CommandRegistry|null $registry
     * @param CommandLocator|null $locator
     * @param CommandHydrator|null $hydrator
     */
    public function __construct(CommandRegistry $registry = null, CommandLocator $locator = null, CommandHydrator $hydrator = null)
    {
        if ($registry === null) {
            $registry = new CommandRegistry();
        }
        $this->registry = $registry;

        if ($locator === null) {
            $locator = new CommandLocator();
        }
        $this->locator = $locator;

        if ($hydrator === null) {
            $hydrator = new CommandHydrator();
            $this->addDefaultProcessors($hydrator);
        }
        $this->hydrator = $hydrator;
    }


    /**
     * @param string $name       name of command
     * @param CommandInterface $command
     */
    public function register($name, CommandInterface $command)
    {
        $this->registry->register($name, $command);
    }

    /**
     * @param ProcessorInterface $processor
     * @param int       $priority
     */
    public function addProcessor(ProcessorInterface $processor, $priority)
    {
        $this->hydrator->addProcessor($processor, $priority);
    }

    /**
     * @param CommandHydrator $hydrator
     */
    public function addDefaultProcessors(CommandHydrator $hydrator)
    {
        $hydrator->addProcessor(new CommandManagerAwareProcessor($this));
    }

    /**
     * execute requests
     *
     * @param mixed $request
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function execute($request)
    {
        $commands = $this->registry->all();

        $locator = $this->locator;
        $command = $locator->locate($commands, $request);

        if ($command === false) {
            throw new InvalidArgumentException(
                sprintf('Missing command for request "%s"', get_class($request))
            );
        }

        $hydrator = $this->hydrator;
        $hydrator->hydrate($command);

        try {
            $response = $command->execute($request);
        } catch (ResponseInterface $e) {
            $response = $e;
            return $response;
        }

        return $response;
    }
}