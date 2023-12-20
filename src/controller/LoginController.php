<?php
namespace App\controller;

use App\entities\Account;
use App\repos\AccountRepo;

class LoginController extends BaseController
{


    public function isLoggedIn()
    {
        return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
    }

    public function read()
    {
        $username = $password = "";
        $username_err = $password_err = $login_err = "";

        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if username is empty
            if (empty(trim($_POST["username"]))) {
                $username_err = "Please enter username.";
            } else {
                $username = trim($_POST["username"]);
            }

            // Check if password is empty
            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter your password.";
            } else {
                $password = trim($_POST["password"]);

            }

            // Validate credentials
            if (empty($username_err) && empty($password_err)) {
                // Prepare a select statement
                $repo = new AccountRepo();
                if ($repo->verifyAccountExists($username)) {
                    $acc = $repo->verifyLogin($username, $password);
                    if ($acc==false) {
                        $login_err = "Invalid username or password.";
                    } else {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $acc["id"];
                        $_SESSION["username"] = $acc["username"];
                        echo $this->render('login.twig', ["session" => $_SESSION]);
                    }

                } else {
                    $login_err = "Invalid username or password.";
                }
            }else {
                $login_err = $username_err . " " . $password_err;
                echo $this->render('login.twig', ["error" => $login_err]);
            }
             if (!empty($login_err)) {
                echo $this->render('login.twig', ["error" => $login_err]);
            }

        }

    }
    public function renderDefault() {
        session_start();
        echo $this->render('login.twig', ['session' => $_SESSION]);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("location: /onePiece/index.php?page=/");
        exit;
    }
}