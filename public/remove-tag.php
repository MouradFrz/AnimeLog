<?php

use src\Controllers\TagController;
use src\Utilities\SessionStatus;

require __DIR__ . '/../vendor/autoload.php';
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if($_SERVER['REQUEST_METHOD']==="POST"){
    $tagid = trim($_POST['tagid']);
    $blogid = $_POST['blogid'];
    TagController::removeTagFromBlog($blogid,$tagid);
}