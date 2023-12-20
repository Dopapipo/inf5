<?php
namespace App\controller;

use App\entities\Comment;
use App\repos\CommentRepo;
use App\Controller\BaseController;

// process_comment.php

// Include Model.php and establish database connection



class CommentController extends BaseController
{
    private CommentRepo $commentModel;
    public function __construct()
    {
        $this->commentModel = new CommentRepo();

    }
    public function getComments()
    {
        return $this->commentModel->getComments();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $content = $_POST['comment'];

            // Add the new comment to the database
            $comment = new Comment($name, $content, "CURRENT_TIMESTAMP");
            $this->commentModel->addComment($comment);

        }
    }

    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $id = $_GET["id"];
            $this->commentModel->deleteComment($id);
        }
    }

    public function renderDefault() {
        $comments = $this->getComments();
        echo $this->render('home.twig', ['comments' => $comments]);
    }
}