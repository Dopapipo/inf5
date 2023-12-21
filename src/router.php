<?php namespace App;

final class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->addRoute('cgv', 'GeneralConditionsController');
    }

    public function addRoute(string $name, string $controller): void
    {
        $this->routes[$name] = $controller;
    }

    public function matchRoute(string $name, ?string $action): bool
    {   
        try {
            if (!$action) {
                throw new \Exception('Controller action needed!');
            }

            $controller = null;

            if (key_exists($name, $this->routes)) {
                $controller = $this->routes[$name];
            }
            if (!file_exists(__DIR__ . "/controller/{$controller}.php")) {
                throw new \Exception(sprintf('File %s not exist!', "{$controller}.php"));
            }

            $controller = new ("App\\controller\\{$controller}")();

            if (!method_exists($controller, $action)) {
                throw new \Exception(sprintf('Action %s not exist in %s!', $action, $controller));
            }
            $controller->$action();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }

        return true;
    }
}