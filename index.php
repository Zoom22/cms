<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\{Router, Application, View};
use App\Controller\{UserController, SubscribeController, NoteController};
use App\Model\Book;

$router = new Router();

$router->get('/', NoteController::class . '@showAll');
$router->get('/auth', UserController::class . '@auth');
$router->post('/auth', UserController::class . '@authorization');
$router->get('/register', UserController::class . '@register');
$router->post('/register', UserController::class . '@addUser');
$router->get('/logout', UserController::class . '@logout');
$router->get('/profile/*', UserController::class . '@profile');
$router->post('/subscribe/*', SubscribeController::class . '@subscribe');
$router->post('/profile/edit', UserController::class . '@profileEdit');

$application = new Application($router);
$application->run();
