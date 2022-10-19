<?php

use src\Controllers\BlogController;

require __DIR__ . '/../vendor/autoload.php';
session_start();

$blogs = BlogController::getRandomBlogs();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimeLog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" integrity="sha512-0SPWAwpC/17yYyZ/4HSllgaK7/gg9OlVozq8K7rf3J8LvCjYEEIfzzpnA2/SSjpGIunCSD18r3UhvDcu/xncWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>
</head>

<body>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <!--  default image where we will set the src via jquery-->
                                <img id="image">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
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
                    <?php foreach($blogs as $blog){?>
                        <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="assets/blog-images/<?=$blog->getImage()?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title"><?=$blog->getTitle()?></h5>
                                <p class="card-text"><?=$blog->getHeadline()?></p>
                                <a href="blog.php?blog=<?=$blog->getId()?>" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>
                    <?php }?>

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $('#trigger').on('click', (e) => {
            $('.image').click()
        })
    </script>
    <script>
        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;


        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                bs_modal.modal('show');
            };


            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "change-image.php",
                        data: {
                            image: base64data
                        },
                        success: function(data) {
                            bs_modal.modal('hide');
                            Toastify({
                                text: "Image succesfully changed. Refresh to view change.",
                                duration: 3000
                            }).showToast();
                        }
                    });
                };
            });
        });
    </script>
</body>

</html>