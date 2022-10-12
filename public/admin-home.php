<?php


require __DIR__ . '/../vendor/autoload.php';

use src\Controllers\BlogController;
use src\Utilities\SessionStatus;
use src\Models\Blog;

session_start();
$blog = new Blog();

SessionStatus::RedirectIfNotLoggedIn('admin');
$blogs = BlogController::getAllBlogs();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blogs Management</title>
    <link href="assets/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/admin-home.css" rel="stylesheet">
    <style>
        .card {
            margin: auto;
        }
    
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin-home.php">
                <div class="sidebar-brand-text mx-3">AnimeLog</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="admin-home.php">
                    <i class="fas fa-fw fa-blog"></i>
                    <span>Blog Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin-logout.php">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li>
            <!-- <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="p-3">
                    <a href="admin-add-blog.php" class="btn-primary btn">Create a new blog</a>
                </nav>
                <section class="mb-5">
                    <div class="container">
                        <h1 class="text-center mb-3">My Blogs</h1>

                        <div class="row mb-5">
                            <?php foreach ($blogs as $index => $blog) { ?>
                                <?php if ($index % 3 === 0 && $index !== 0) { ?>
                        </div>
                        <div class="row mb-5">
                        <?php } ?>
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="assets/blog-images/<?=$blog->getImage()?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $blog->getTitle() ?></h5>
                                    <p class="card-text"><?= $blog->getHeadline() ?></p>
                                    <a href="#" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        </div>
                    </div>
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </section>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/admin-home.js"></script>

</body>

</html>