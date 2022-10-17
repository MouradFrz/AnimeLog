<?php

use src\Controllers\SectionController;
use src\Utilities\SessionStatus;

require __DIR__ . '/../vendor/autoload.php';
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if($_SERVER['REQUEST_METHOD']==="POST"){
    $blogid = $_POST['blogid'];
    $sectionid = $_POST['sectionid'];
    SectionController::deleteSection($sectionid);
    $_SESSION['message']="Sections deleted successfully";
    header('Location: admin-blog-details.php?blog='.$blogid);
}