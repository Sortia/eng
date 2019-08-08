<?php

namespace Controllers;

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$collector = new RouteCollector();

$collector->controller('/flashcard', 'Controllers\\FlashcardController');
$collector->controller('/item', 'Controllers\\ItemController');
$collector->controller('/auth', 'Controllers\\AuthController');
$collector->controller('/vocabulary', 'Controllers\\VocabularyController');
$collector->controller('/', 'Controllers\\HomeController');
$collector->controller('/profile', 'Controllers\\ProfileController');
$collector->controller('/settings', 'Controllers\\SettingsController');

$collector->get('/items/{id}', ['Controllers\\ItemController','get']);

$dispatcher = new Dispatcher($collector->getData());

$dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

