<?php
namespace App\repos;

use PDO;
use App\DatabaseResolver;
use App\entities\Account;
    class AccountRepo extends DatabaseResolver {
        public function __construct() {
            parent::__construct("accounts");
        }

        public function submitAccount(Account $account) {
            $email = $account->getEmail();
            $name = $account->getName();
            if (empty($this->checkIfAccountExists($email))&&empty($this->checkIfAccountNameExists($name))) {
                $this->addAccount($account);
            } else {
                return $this->checkIfAccountExists($email).$this->checkIfAccountNameExists($name);
            }
            
        }
        public function addAccount(Account $account) {
            $table = $this->getTable();
            $email = $account->getEmail();
            $name = $account->getName();
            $password = $account->getPassword();
            $query = "INSERT INTO $table
            (username, email, password) VALUES (:name, :email, :password)";
            $statement = $this->getDatabase()->prepare($query);
            $statement->bindParam(":name", $name);
            $statement->bindParam(":password", $password);
            $statement->bindParam(":email", $email);
            $statement->execute();
        }

        public function checkIfAccountExists($email):string {
            $table = $this->getTable();
            $error_msg = "";
            $query = "SELECT * FROM $table WHERE email = :email";
            $statement = $this->getDatabase()->prepare($query);
            $statement->bindParam(":email", $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result != false) {
                $error_msg = "Account email already exists";
            }
            return $error_msg;
        }
        public function checkIfAccountNameExists($name):string {
            $table = $this->getTable();
            $error_msg = "";
            $query = "SELECT * FROM $table WHERE username = :name";
            $statement = $this->getDatabase()->prepare($query);
            $statement->bindParam(":name", $name);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result != false) {
                $error_msg = "Account name already exists";
            }
            return $error_msg;
        }

        private function getAccountByName($name) {
            $table = $this->getTable();
            $query = "SELECT * FROM $table WHERE username = :name";
            $statement = $this->getDatabase()->prepare($query);
            $statement->bindParam(":name", $name);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        //true if account exists
        public function verifyAccountExists($name):bool {
            $result = $this->getAccountByName($name);
            return $result != false;
        }

        public function verifyLogin($name, $password) {
            $result = $this->getAccountByName($name);
            if ($result != false && password_verify($password, $result["password"])) {
                    return $result;
            }
            return false;
        }


        
    }