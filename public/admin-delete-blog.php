<?php

use src\Controllers\BlogController;
use src\Utilities\SessionStatus;

require __DIR__ . '/../vendor/autoload.php';
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if($_SERVER['REQUEST_METHOD']==="POST"){
    $blogid = $_POST['blogid'];
    if(BlogController::blogExists($blogid)){
        BlogController::deleteBlog($blogid);
        $_SESSION['message'] = "Blog deleted successfully";
        header('Location: admin-home.php');
    }
}