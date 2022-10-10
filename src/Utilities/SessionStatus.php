<?php
namespace src\Utilities;
class SessionStatus{
    public static function LoggedIn(){
        return isset($_SESSION['loggedin']);
    }

    public static function RedirectIfLoggedIn(){
        if (self::LoggedIn()) {
            header('Location: index.php');
            die;
        }
    }
    public static function RedirectIfNotLoggedIn(){
        if (!self::LoggedIn()) {
            header('Location: login.php');
            die;
        }
    }
}