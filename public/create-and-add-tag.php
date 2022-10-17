<?php
require __DIR__ . '/../vendor/autoload.php';

use src\Controllers\TagController;
use src\Utilities\SessionStatus;
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if($_SERVER['REQUEST_METHOD']==="POST"){
    $tagname = $_POST['tagname'];
    $blogid = $_POST['blogid'];

    TagController::createAndAdd($blogid,$tagname);
    echo $tagname;
}