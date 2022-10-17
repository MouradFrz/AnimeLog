<?php
require __DIR__ . '/../vendor/autoload.php';

use src\Controllers\TagController;
use src\Utilities\SessionStatus;
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if($_SERVER['REQUEST_METHOD']==="POST"){
    $tagid = $_POST['tagid'];
    $blogid = $_POST['blogid'];

    TagController::addTagToBlog($blogid,$tagid);
}