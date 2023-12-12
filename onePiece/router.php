<?php
class Router {
    private $routes = [];

    public function addRoute($route, $action) {
        $this->routes[$route] = $action;
    }

    public function handleRequest($request) {
        if (array_key_exists($request, $this->routes)) {
            $action = $this->routes[$request];
            $this->executeAction($action);
        } else {
            echo '404 - Page not found';
        }
    }
    private function executeAction($action) {
        switch ($action) {
            case 'home':
                include 'home.php';
                break;
            case 'signupPage':
                include 'signup.php';
                break;
            default:
                echo '404 - Page not found'; 
                break;
        }
    }
}
