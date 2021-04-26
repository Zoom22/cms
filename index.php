<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\{Router, Application, View};
use App\Controller\{UserController, SubscribeController, NoteController, PageController};
use App\Model\Book;

$router = new Router();

$router->get('/', NoteController::class . '@showAll'); //переделать на показ через show, если не передан $id
$router->get('/note/*', NoteController::class . '@show');

$router->get('/page/create', PageController::class . '@create');
$router->post('/page/store', PageController::class . '@store');
$router->get('/page/*', PageController::class . '@show');
$router->get('/rules', PageController::class . '@rules');
$router->get('/contacts', PageController::class . '@contacts');
$router->get('/about', PageController::class . '@about');


$router->get('/auth', UserController::class . '@authorization');
$router->post('/auth', UserController::class . '@login');
$router->get('/register', UserController::class . '@create');
$router->post('/register', UserController::class . '@store');
$router->get('/logout', UserController::class . '@logout');

$router->post('/profile/edit', UserController::class . '@profileEdit');
$router->get('/profile/*', UserController::class . '@show');
$router->post('/subscribe/*', SubscribeController::class . '@subscribe');

$application = new Application($router);
$application->run();
