<?php

use src\Controllers\SectionController;
use src\Models\Section;
use src\Utilities\SessionStatus;

require __DIR__ . '/../vendor/autoload.php';
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if($_SERVER['REQUEST_METHOD']==="POST"){
    $blogid = $_POST['blogid'];
    $sectionid = $_POST['sectionid'];
    if(!SectionController::sectionExists($sectionid)){
        echo "Section doesn't exist";
    }

    $title = $_POST['title'];
    $paragraph = $_POST['paragraph'];
    $image = $_FILES['banner'];
    $section = new Section();

    $section->setId($sectionid);
    $section->setTitle($title);
    $section->setParagraph($paragraph);
    $section->setImage($image);

    SectionController::updateSection($section);
    $_SESSION["message"] = 'Section updated successfully';
    header('Location: admin-blog-details.php?blog='.$blogid);
}