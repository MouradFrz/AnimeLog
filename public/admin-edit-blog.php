<?php

use src\Controllers\BlogController;
use src\Models\Blog;
use src\Utilities\SessionStatus;

require __DIR__ . '/../vendor/autoload.php';
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if($_SERVER['REQUEST_METHOD']==="POST"){
    $blogid = $_POST['blogid'];
    $title = $_POST['title'];
    $headline = $_POST['headline'];
    $image = $_FILES['banner'];
    $blog = new Blog();
    $blog->setTitle($title);
    $blog->setHeadline($headline);
    $blog->setImage($image);
    if(BlogController::validateBlog($blog)){
        BlogController::editBlog($blogid,$blog);
        $_SESSION['message']="Blog edited successfully.";
        header("Location: admin-home.php");
    }else{
        $_SESSION['message']="Invalid inputs. Blog not edited";
    }

}

?>