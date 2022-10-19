<?php

use src\Controllers\BlogController;
use src\Utilities\SessionStatus;

include __DIR__ . '../../vendor/autoload.php';

if (!isset($_GET['keyword'])) {
    echo 'Invalid keyword';
    die;
}
$keyword = $_GET['keyword'];
$blogs = BlogController::searchBlogs($keyword);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img alt="" width="30" height="24" class="d-inline-block align-text-top" src="assets/images/logo.png">
                AnimeLog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <form class="d-flex" method="GET" action="blog-search.php" style="margin:auto;">
                    <input class="form-control me-2" name="keyword" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success " type="submit"><i class="bi bi-search"></i></button>
                </form>
                <?php if (!isset($_SESSION['loggedin'])) { ?>
                    <ul class="navbar-nav">
                        <a href="login.php" class="mx-2 btn btn-success btn-outline btn-sm">Login</a>
                        <a href="register.php" class="btn btn-outline-success btn-sm">Register</a>
                    </ul>
                <?php } else { ?>
                    <div class="d-flex align-items-center" style="gap:8px">
                        <div class="profile-image">
                            <input type="file" name="image" class="image" style="display:none;">
                            <span id="trigger"></span>
                            <img width="30" height="30" class="d-inline-block align-text-top" src="<?= 'assets/profile-images/' . $_SESSION['loggedin'] . '.png' ?>" alt="">
                        </div>

                        <p style="font-size:0.7rem ;margin:0;"><?= $_SESSION['loggedin'] ?></p>
                        <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>
    <main class="bg-light">
        <div class="container">
            <div class="wrapper">
                <?php if (count($blogs) === 0) { ?>
                    <section>
                        <div class="no-result">
                            <h1 class="text-center">No result found for your search</h1>
                        </div>
                    </section>
                <?php } else { ?>
                    <?php foreach($blogs as $blog){?>
                    <section>
                        <a href="blog.php?blog=<?=$blog->getId()?>" class="blog-mini">
                            <img src="assets/blog-images/<?= $blog->getImage() ?>" alt="">
                            <div>
                                <h1><?= $blog->getTitle() ?></h1>
                                <p class="mb-0"><?= $blog->getHeadline() ?></p>
                                <p class="date color-light"><?= $blog->getCreatedAt() ?></p>
                            </div>
                        </a>
                    </section>
                    <?php }?>
                <?php } ?>
            </div>

        </div>
    </main>
</body>

</html>