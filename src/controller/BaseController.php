<?php

namespace App\controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class BaseController
{
    public function render(string $template, array $variables): string
    {
        $loader = new FilesystemLoader(sprintf('%s/templates/', dirname(__DIR__)));
        $twig = new Environment($loader, [
            'debug' => true,
            'path' => true,
        ]);
        $twig->addExtension(new DebugExtension());

        return $twig->render($template, $variables);
    }
    public abstract function renderDefault();

    public function headHome() {
        header("Location: index.php?page=/");
    }
}