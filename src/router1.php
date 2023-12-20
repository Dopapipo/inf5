<?php namespace App;
use App\controller\HomeController;
use App\controller\LoginController;
use App\controller\SignupController;
use App\controller\CommentController;

class Router {
    private array $routes = [];
    
    public function addRoute($name, $controller) {
        $this->routes[$name] = $controller;
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
        $login = new LoginController();
        $logged = $login->isLoggedIn();
        $session = $logged? $_SESSION : null;
        switch ($action) {
            case 'homeController':
                $controller = new HomeController();
                $comments = $controller->getComments();
                echo $controller->render("home.twig", ["comments" => $comments,
                "logged" => $logged,
                "session" => $session] );
                break;
            case 'signupController':
                $controller = new SignupController();
                $controller->handleSubmission();
                break;
            case 'commentSubmit':
                $controller = new CommentController();
                if (isset($_POST['name']) && isset($_POST['comment'])) {
                    $controller->handleSubmission();
                }
                header("Location: /onePiece/index.php?page=/");
                break;
            case 'deleteComment':
                $controller = new CommentController();
                if (isset($_GET['id'])) {
                    $controller->handleDelete();
                }
                header("Location: /onePiece/index.php?page=/");
                break;
            case 'loginController':
                $controller = new LoginController();
                echo $controller->render('login.twig', ['logged' => $logged]);
                break;
            default:
                echo '404 - Page not found';
                break;
        }
    }
}
