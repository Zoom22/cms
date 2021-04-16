<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\{Router, Application, View};
use App\Controller\{UserController, SubscribeController};
use App\Model\Book;

$router = new Router();

$router->get('/', function() {
    //todo следить за стартом сессии в таких коллбэках, сделать универсально
    session_start();
    return new View('index', ['title' => 'Index Page']);
});
$router->get('/auth', UserController::class . '@auth');
$router->post('/auth', UserController::class . '@authorization');
$router->get('/register', UserController::class . '@register');
$router->post('/register', UserController::class . '@addUser');
$router->get('/logout', UserController::class . '@logout');
$router->get('/profile/*', UserController::class . '@profile');
$router->post('/subscribe/*', SubscribeController::class . '@subscribe');

$application = new Application($router);
$application->run();
