<?php

namespace src\Utilities;

class SessionStatus
{
    public static function LoggedIn($string)
    {
        if ($string === "admin") {
            return isset($_SESSION['loggedinadmin']);
        }
        if ($string === "user") {
            return isset($_SESSION['loggedin']);
        }
    }

    public static function RedirectIfLoggedIn($string)
    {
        if (self::LoggedIn($string)) {
            if ($string === "admin") {
                header('Location: admin-home.php');
            }
            if ($string === "user") {
                header('Location: index.php');
            }
            die;
        }
    }
    public static function RedirectIfNotLoggedIn($string)
    {
        if (!self::LoggedIn($string)) {
            if ($string === "admin") {
                header('Location: admin-login.php');
            }
            if ($string === "user") {
                header('Location: login.php');
            }
            die;
        }
    }
}
