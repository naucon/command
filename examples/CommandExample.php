<?php

require realpath(__DIR__ . '/../') . '/vendor/autoload.php';

use Naucon\Command\CommandManager;
use Naucon\Command\Tests\Action\PowerOnAction;
use Naucon\Command\Tests\Action\PowerOffAction;
use Naucon\Command\Tests\Request\PowerOnRequest;
use Naucon\Command\Tests\Request\PowerOffRequest;
use Naucon\Command\Tests\Model\Light;

$manager = new CommandManager();
$manager->register('power_on', new PowerOnAction());
$manager->register('power_off', new PowerOffAction());

$light = new Light();

echo 'Light is ' . $light->getStatus() . '<br/>';

$request = new PowerOnRequest($light);
$manager->execute($request);

echo 'Light is ' . $light->getStatus() . '<br/>';

$request = new PowerOffRequest($light);
$manager->execute($request);

echo 'Light is ' . $light->getStatus() . '<br/>';
