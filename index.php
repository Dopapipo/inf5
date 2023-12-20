<?php
require_once __DIR__. '/vendor/autoload.php';
$root = $_SERVER['DOCUMENT_ROOT'];
use App\Router;
$router = new Router();
$router->addRoute('/', 'HomeController');
$router->addRoute('signup', 'SignupController');
$router->addRoute('comment','CommentController');
$router->addRoute('delete', 'CommentController');
$router->addRoute('login', 'LoginController');
$router->matchRoute($_GET['page'], $_GET['action'] ?? "renderDefault");
