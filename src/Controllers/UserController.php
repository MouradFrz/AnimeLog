<?php

namespace src\Controllers;

use PDO;
use src\Models\User;
use src\Utilities\Database;

class UserController
{

    public static function completeFields(User $user)
    {
        if (!$user->getEmail() || !$user->getPassword() || !$user->getConfirmPassword()) {
            return false;
        }
        return true;
    }
    public static function validateEmailFormat(User $user)
    {
        return filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL);
    }
    public static function validatePassword(User $user)
    {
        return preg_match("(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$)", $user->getPassword()) && strlen($user->getPassword()) >= 6;
    }
    public static function validateConfirm(User $user)
    {
        return $user->getPassword() === $user->getConfirmPassword();
    }
    public static function validateTakenEmail(User $user)
    {
        $pdo = Database::connect();
        $stmt = $pdo->query('SELECT * FROM users');
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo = NULL;
        foreach($results as $row){
            if($row->email === $user->getEmail()){
                return false;
            }
        }
        return true;
    }
    public static function createNewUser(User $user):void{
        $pdo = Database::connect();
        $password = password_hash($user->getPassword(),PASSWORD_DEFAULT);
        $email = $user->getEmail();
        $stmt = $pdo->prepare("INSERT INTO users (email,password) VALUES ('$email','$password')");
        $stmt->execute();
        $pdo = NULL;
    }

    public static function attemptLogin($email,$password){
        $pdo = Database::connect();
        $stmt = $pdo->query('SELECT * FROM users');
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($results as $row){
            if($row->email === $email){
                if(password_verify($password,$row->password)){
                    $_SESSION['loggedin']=$row->email;
                    return true;
                }
                return false;
            }
        }
        return false;
    }
}
