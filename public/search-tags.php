<?php
require __DIR__ . '/../vendor/autoload.php';

use src\Controllers\TagController;
use src\Utilities\SessionStatus;
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if($_SERVER['REQUEST_METHOD']==="POST"){
    $keyword = trim($_POST['keyword']);
    $blogid = $_POST['blogid'];
    print_r(json_encode(TagController::findTags($keyword,$blogid)));
}