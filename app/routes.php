<?php

namespace Controllers;

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$collector = new RouteCollector();

$collector->controller('/', 'Controllers\\BlockController');
$collector->controller('/item', 'Controllers\\ItemController');


$dispatcher = new Dispatcher($collector->getData());

$dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

