<?php

use src\Controllers\BlogController;
use src\Controllers\SectionController;
use src\Utilities\SessionStatus;
use src\Models\Section;

require __DIR__ . '/../vendor/autoload.php';
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');
if($_SERVER['REQUEST_METHOD']==="POST"){
    $blogid = $_POST['blogid'];
    if(!BlogController::blogExists($blogid)){
        echo "Blog doesn't exist";
    }
    $title = $_POST['title'];
    $paragraph = $_POST['paragraph'];
    $image = $_FILES['banner'];

    $section = new Section();
    $section->setTitle($title);
    $section->setParagraph($paragraph);
    $section->setImage($image);

    SectionController::createSection($section,$blogid);
    $_SESSION["message"] = 'Section created successfully';
    header('Location: admin-blog-details.php?blog='.$blogid);
}