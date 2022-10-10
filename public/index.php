<?php
require __DIR__ . '/../vendor/autoload.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimeLog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

            <form class="d-flex" style="margin:auto;">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav">
                    <a href="login.php" class="mx-2 btn btn-success btn-outline">Login</a>
                    <a href="register.php" class="btn btn-outline-success">Register</a>
                </ul>
            </div>
        </div>
    </nav>
    <main class="bg-light">
        <section class="mb-5 pb-4">
            <div class="container">
                <div class="d-flex flex-column align-items-center">
                    <img class="w-50" src="assets/images/header.png" alt="">
                    <h1 class="fs-1">AnimeLog</h1>
                    <p class="fs-6">Your go to for anime talk!</p>
                </div>
            </div>
        </section>
        <section class="mb-5">
            <div class="container">
                <h1 class="text-center mb-3">Trending topics</h1>
                <div class="row">
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="assets/images/placehold.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="assets/images/placehold.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="assets/images/placehold.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<footer class="text-center text-lg-start bg-light text-muted">
  
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href="https://github.com/MouradFrz">Yaou Mourad</a>
  </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>