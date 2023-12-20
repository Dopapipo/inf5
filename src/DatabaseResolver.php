<?php  namespace App;
use PDO;

class DatabaseResolver {
    private PDO $database;
    private string $table;
    public function __construct($table) {
        $this->database = new PDO("mysql:host=localhost;dbname=onepiece", "root", "");
        $this->table = $table;
    }
    public function getDatabase() {
        return $this->database;
    }
    public function getTable() {
        return $this->table;
    }

}