<?php

namespace Controllers;

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$collector = new RouteCollector();

$collector->controller('/flashcard', 'Controllers\\FlashcardController');
$collector->controller('/auth', 'Controllers\\AuthController');
$collector->controller('/vocabulary', 'Controllers\\VocabularyController');
$collector->controller('/', 'Controllers\\HomeController');
$collector->controller('/profile', 'Controllers\\ProfileController');
$collector->controller('/settings', 'Controllers\\SettingsController');

$collector->get('/items/{id}', ['Controllers\\ItemController','get']);
$collector->post('/items/{id}/create', ['Controllers\\ItemController','postCreate']);
$collector->post('/items/{id}/update', ['Controllers\\ItemController','postUpdate']);
$collector->post('/items/{id}/delete', ['Controllers\\ItemController','postDelete']);

$dispatcher = new Dispatcher($collector->getData());

$dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);