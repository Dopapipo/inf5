<?php
namespace App\controller;

use App\entities\Account;
use App\controller\validator\FormValidator;
use App\repos\AccountRepo;
use App\controller\BaseController;

class SignupController extends BaseController
{
    private AccountRepo $accRepo;
    public function __construct()
    {
        $this->accRepo = new AccountRepo();
    }



    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            array_filter($_POST, 'trim');
            
            $name = $_POST['nickname'];
            $email = filter_var ($_POST['mail'],FILTER_SANITIZE_EMAIL);
            $emailConfirm = filter_var ($_POST['mailre'],FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $passwordConfirm = $_POST['passwordre'];
            $validator = new FormValidator($name, $email,
            $emailConfirm,$password, $passwordConfirm);
            if ($validator->isValid()) {
                $account = new Account($name, password_hash($password,PASSWORD_DEFAULT),$email);
                $submitted_err = $this->accRepo->submitAccount($account);
                if (empty($submitted_err)) { //check if acc name/email doesn't already exist
                echo $this->render('signup.twig', ['isValid' => true]);
                }
                else {
                    echo $this->render('signup.twig', ['isValid' => false,
                    'errorMessage' => $submitted_err]);
                }
            } else {
                echo $this->render('signup.twig', ['isValid' => false,
                    'errorMessage' => $validator->getErrorMessage()]);
            }

        } else {
            echo $this->render('signup.twig', ['isValid' => "default"]);
        }
    }
    public function renderDefault() {
        echo $this->render('signup.twig', ['isValid' => "default"]);
    }

}