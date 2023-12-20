<?php
namespace App\controller;

use App\controller\CommentController;

class HomeController extends CommentController
{

    public function renderDefault()
    {   session_start();
        $comments = $this->getComments();
        echo $this->render("home.twig", ["comments" => $comments,
            "session" => $_SESSION]);
    }
}