<?php 
namespace src\Models;
class User{
    private string $email;
    private string $password;
    private string $confirmPassword;
    public function __construct($email,$password = null,$confirmPassword = null)
    {
        $this->email=$email;
        $this->password=$password;
        $this->confirmPassword=$confirmPassword;
    }
    
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($value){
        $this->email = $value;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($value){
        $this->password = $value;
    }
    public function getConfirmPassword(){
        return $this->confirmPassword;
    }
    public function setConfirmPassword($value){
        $this->confirmPassword = $value;
    }
}