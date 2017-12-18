<?php

require realpath(__DIR__ . '/../') . '/vendor/autoload.php';

use Naucon\Command\CommandManager;
use Naucon\Command\Tests\Action\FooAction;
use Naucon\Command\Tests\Action\BarAction;
use Naucon\Command\Tests\Request\BarRequest;

$manager = new CommandManager();
// returns 'foo'
$manager->register('foo', new FooAction());
// executes and returns FooAction and add 'bar'
$manager->register('bar', new BarAction());

$request = new BarRequest();
$response = $manager->execute($request);

echo $response; // foobar
