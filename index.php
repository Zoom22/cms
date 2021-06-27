<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\{Router, Application};
use App\Controller\{UserController, SubscribeController, NoteController, CommentController, StaticPageController, AdminController};

$router = new Router();
$router->get('/', NoteController::class . '@showAll'); //переделать на показ через show, если не передан $id
$router->post('/', SubscribeController::class . '@create');

$router->get('/notes/create', NoteController::class . '@create');
$router->post('/notes/store', NoteController::class . '@store');
$router->get('/notes/*', AdminController::class . '@notes');
$router->post('/notes/*', NoteController::class . '@delete');

$router->get('/note/*', NoteController::class . '@show');
$router->get('/page/*', NoteController::class . '@showAll');
$router->get('/static/create', StaticPageController::class . '@create');
$router->post('/static/store', StaticPageController::class . '@store');
$router->get('/statics/*', AdminController::class . '@statics');
$router->get('/static/*', StaticPageController::class . '@show');
$router->get('/rules', StaticPageController::class . '@rules');
$router->get('/contacts', StaticPageController::class . '@contacts');
$router->get('/about', StaticPageController::class . '@about');


$router->get('/auth', UserController::class . '@authorization');
$router->post('/auth', UserController::class . '@login');
$router->get('/register', UserController::class . '@create');
$router->post('/register', UserController::class . '@store');
$router->get('/logout', UserController::class . '@logout');

$router->post('/profile/edit', UserController::class . '@profileEdit');
$router->get('/profile/*', UserController::class . '@show');
$router->post('/profile/*', SubscribeController::class . '@subscribe');

$router->get('/users/*', AdminController::class . '@users');
$router->post('/users/*', SubscribeController::class . '@subscribe');
$router->post('/users/change/', UserController::class . '@changeGroup');

$router->get('/subscribers/*', AdminController::class . '@subscribers');
$router->post('/subscribers/*', SubscribeController::class . '@subscribe');

$router->post('/note/*', CommentController::class . '@store');
$router->get('/comments/*', AdminController::class . '@comments');


$application = new Application($router);
$application->run();
