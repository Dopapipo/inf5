<?php namespace App\entities;

    class Account {
        public $name;
        public $email;
        public $password;
        public function __construct($name, $password, $email="") {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }
        public function getName() {
            return $this->name;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getPassword() {
            return $this->password;
        }

    }