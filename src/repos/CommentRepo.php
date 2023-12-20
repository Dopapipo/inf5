<?php
namespace App\repos;

use PDO;
use App\DatabaseResolver;

class CommentRepo extends DatabaseResolver {
    public function __construct() {
        parent::__construct("comments");
    }
    public function addComment($comment) {
        $table = $this->getTable();
        // Prepare INSERT query
        $query = "INSERT INTO $table (name, comment, created_at) VALUES (:name, :comment, CURRENT_TIMESTAMP)";
        // Prepare and execute the statement
        $statement = $this->getDatabase()->prepare($query);
        $name = $comment->getName();
        $statement->bindParam(':name', $name);
        $content = $comment->getContent();
        $statement->bindParam(':comment', $content);
        $statement->execute();
    }
    public function deleteComment($id) {
        $table = $this->getTable();
        $query = "DELETE FROM $table WHERE id = :id";
        $statement = $this->getDatabase()->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
    public function getComments() {
        $table = $this->getTable();
        // Query to fetch comments from the database
        $query = "SELECT * FROM $table ORDER BY created_at DESC";

        // Execute the query
        $result = $this->getDatabase()->query($query);

        // Fetch comments as an associative array
        $comments = $result->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }


}