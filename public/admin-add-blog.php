<?php

use src\Controllers\BlogController;
use src\Models\Blog;
use src\Utilities\SessionStatus;

require __DIR__ . '/../vendor/autoload.php';
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = $_POST['title'];
    $headline = $_POST['headline'];
    $image = $_FILES['banner'];
    $blog = new Blog();
    $blog->setTitle($title);
    $blog->setHeadline($headline);
    $blog->setImage($image);
    if (BlogController::validateBlog($blog)) {
        BlogController::createBlog($blog);
        $result = '';
    } else {
        $error = 'Title and headline must be less than 240 chars.<br>All fields are required.';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body class="bg-light">
    <div class="wrapper">
        <?php
        if (isset($result) && !$result) {
            echo '<p>Blog Created successfully</p>';
        }
        if (isset($error)) {
            echo $error;
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <h1 class="text-center">Create new blog</h1>
            <div class="form-outline mb-4">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Headline</label>
                <input type="text" name="headline" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Image</label>
                <input type="file" accept="image/png, image/gif, image/jpeg" name="banner" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-4">Create</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>