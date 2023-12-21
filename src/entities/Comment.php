<?php namespace App\entities;
class Comment {
    private string $name;
    private string $content;

    private string $author;
    public function __construct(string $name, string $content, string $author = "NULL") {
        $this->name = $name;
        $this->content = $content;
        $this->author = $author;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getContent(): string {
        return $this->content;
    }
    public function getAuthor(): string {
        return $this->author;
    }

}