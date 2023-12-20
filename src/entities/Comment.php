<?php namespace App\entities;
class Comment {
    private string $name;
    private string $content;

    public function __construct(string $name, string $content) {
        $this->name = $name;
        $this->content = $content;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getContent(): string {
        return $this->content;
    }

}