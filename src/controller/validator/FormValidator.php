<?php
namespace App\controller\validator;

class FormValidator
{
    private string $name;

    private string $email;

    private string $emailre;

    private string $password;

    private string $passwordRe;

    public function __construct(string $name, string $email,
        string $emailre, string $password, string $passwordRe)
    {
        $this->name = $name;
        $this->email = $email;
        $this->emailre = $emailre;
        $this->password = $password;
        $this->passwordRe = $passwordRe;
    }

    public function isValid(): bool
    {

        return $this->email === $this->emailre
            && $this->password === $this->passwordRe && $this->password != ''
            && $this->passwordRe !== ''&& $this->email !== ''&& $this->emailre !== ''
            && $this->name !=='';
    }
    public function getErrorMessage() {
        
        $toReturn = '';
        if ($this->email !== $this->emailre) {
            $toReturn.="The emails do not match!"."\n";
        }
        if ($this->password !== $this->passwordRe) {
            $toReturn.= "The passwords do not match!"."\n";
        }
        if (!($this->password != ''
        && $this->passwordRe !== ''&& $this->email !== ''&& $this->emailre !== ''
        && $this->name !==''))
            {
                $toReturn.= "Please fill in all the fields!"."\n";
            }
        return $toReturn;
    }
    
}