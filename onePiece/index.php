<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root.'/onePiece/router.php';
$router = new Router();
$router->addRoute('page=/', 'home');
$router->addRoute('page=signup', 'signupPage');
$request = $_SERVER['QUERY_STRING'];
$router->handleRequest($request);
