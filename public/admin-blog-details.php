<?php

use src\Controllers\BlogController;
use src\Controllers\SectionController;
use src\Controllers\TagController;
use src\Utilities\SessionStatus;

require __DIR__ . '/../vendor/autoload.php';
session_start();
SessionStatus::RedirectIfNotLoggedIn('admin');
if (!isset($_GET['blog'])) {
    echo 'invalid url';
    die;
}
$blogid = $_GET['blog'];
if (!BlogController::blogExists($blogid)) {
    echo 'invalid blog id';
    die;
}
$tags = TagController::fetchTagsForBlog($blogid);
$blog = BlogController::getBlogInfo($blogid);
$sections = SectionController::loadSections($blogid);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blogs Management</title>
    <link href="assets/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="assets/css/admin-home.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/blog-details.css">
</head>

<body id="page-top">
    <div class="modal fade" id="deleteSectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="admin-delete-section.php" method="POST" id="delete-section">
                        <p>Are you sure you want to delete this section?</p>
                        <input type="hidden" name="blogid" value="<?= $blogid ?>">
                        <input type="hidden" name="sectionid" id="section-delete-input">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="document.querySelector('#delete-section').submit()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="admin-edit-section.php" method="POST" id="edit-section" enctype="multipart/form-data">
                        <input type="hidden" name="blogid" value="<?= $blogid ?>">
                        <input type="hidden" name="sectionid" id="section-edit-input">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="">
                        <label for="" class="form-label">Paragraph</label>
                        <textarea name="paragraph" id="" class="form-control"></textarea>
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" accept="image/png, image/gif, image/jpeg" name="banner" id="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="document.querySelector('#edit-section').submit()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="admin-edit-blog.php" method="POST" id="edit-blog" enctype="multipart/form-data">
                        <input type="hidden" name="blogid" value="<?= $blogid ?>">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="">
                        <label for="" class="form-label">Headline</label>
                        <input type="text" class="form-control" name="headline" id="">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" accept="image/png, image/gif, image/jpeg" name="banner" id="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="document.querySelector('#edit-blog').submit()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="admin-create-section.php" method="POST" id="create-section" enctype="multipart/form-data">
                        <input type="hidden" name="blogid" value="<?= $blogid ?>">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="">
                        <label for="" class="form-label">Paragraph</label>
                        <textarea name="paragraph" id="" class="form-control"></textarea>
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" accept="image/png, image/gif, image/jpeg" name="banner" id="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="document.querySelector('#create-section').submit()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
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
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container">
                    <?php if (isset($_SESSION['message'])) { ?>
                        <p><?= $_SESSION['message'] ?></p>
                    <?php unset($_SESSION['message']);
                    } ?>
                    <nav class="mt-2 d-flex">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Edit Blog
                        </button>
                        <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                            Add a new section
                        </button>
                        <form action="admin-delete-blog.php" method="post" class="">
                            <input type="hidden" name="blogid" value="<?= $blogid ?>">
                            <button type="submit" class="btn-danger btn">Delete this blog</button>
                        </form>
                    </nav>
                </div>
                <section class="mb-5">
                    <div class="container">
                        <div class=" mt-3 existing-tags">
                            <?php foreach ($tags as $tag) { ?>
                                <span class="tag me-2" data-tagid="<?= $tag->id ?>">
                                    <p class="d-inline"><?= $tag->name ?></p>
                                </span>
                            <?php } ?>
                        </div>
                        <div class="search-div">
                            <input type="text" name="" placeholder="Tagname..." class="form-control mt-3" id="add-tag-input">
                            <div class="search-result">
                            </div>
                        </div>
                        <h1 class="mb-3">Blog : <?= $blog->getTitle() ?></h1>
                        <p><?= $blog->getHeadline() ?></p>
                        <img width="60%" src="assets/blog-images/<?= $blog->getImage() ?>" alt="">
                        <?php foreach ($sections as $section) { ?>
                            <div class="section">
                                <div class="section-buttons d-flex justify-content-between">
                                    <h3 class="mb-3"><?= $section->getTitle() ?></h3>
                                    <div class="section-params">
                                        <button type="button" class="btn-outline btn-primary btn editsectionbutton" data-sectionid="<?= $section->getId() ?>" data-bs-toggle="modal" data-bs-target="#editSectionModal"><i class="bi bi-gear-fill"></i></button>
                                        <button type="button" class="btn-outline btn-danger btn deletesectionbutton" data-sectionid="<?= $section->getId() ?>" data-bs-toggle="modal" data-bs-target="#deleteSectionModal"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </div>
                                <p><?= $section->getParagraph() ?></p>
                                <img width="60%" src="assets/section-images/<?= $section->getImage() ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
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
    <script>
        const sectionEditInput = document.querySelector('#section-edit-input')
        const editSectionButton = document.querySelectorAll('.editsectionbutton')
        editSectionButton.forEach((e) => {
            e.addEventListener('click', () => {
                sectionEditInput.value = e.dataset.sectionid
            })
        })
    </script>

    <script>
        const sectionDeleteInput = document.querySelector('#section-delete-input')
        const deleteSectionButton = document.querySelectorAll('.deletesectionbutton')
        deleteSectionButton.forEach((e) => {
            e.addEventListener('click', () => {
                sectionDeleteInput.value = e.dataset.sectionid
            })
        })
    </script>
    <script>
        const tags = document.querySelectorAll('.tag')
        tags.forEach((e) => {
            e.addEventListener('click', () => {
                $.ajax({
                    url: 'remove-tag.php',
                    type: 'post',
                    data: {
                        tagid: e.dataset.tagid,
                        blogid: <?= $blogid ?>
                    },
                    success: () => {
                        e.parentElement.removeChild(e);
                    },
                })
            })
        })
    </script>
    <script>
        const tagSearchInput = document.querySelector('#add-tag-input')
        const searchResult = document.querySelector('.search-result')
        const existingTags = document.querySelector('.existing-tags')

        let searchString = tagSearchInput.value

        tagSearchInput.addEventListener('keyup', () => {
            searchString = tagSearchInput.value
            if (searchString.length > 1) {
                $.ajax({
                    url: 'search-tags.php',
                    type: 'POST',
                    data: {
                        blogid: <?= $blogid ?>,
                        keyword: searchString
                    },
                    success: (res) => {
                        searchResult.textContent = ''
                        JSON.parse(res).forEach((tag) => {
                            let p = document.createElement('p')
                            p.textContent = tag.name
                            p.setAttribute('data-tagid', tag.id)
                            p.addEventListener('click', () => {
                                $.ajax({
                                    url: 'add-tag-to-blog.php',
                                    type: 'POST',
                                    data: {
                                        tagid: p.dataset.tagid,
                                        blogid: <?= $blogid ?>
                                    },
                                    success: () => {
                                        p.parentElement.removeChild(p)
                                        let temp = document.createElement('span')
                                        temp.innerHTML = `<p class = "d-inline">${p.textContent}</p>`
                                        temp.classList.add('tag')
                                        temp.classList.add('me-2')
                                        temp.setAttribute('data-tagid', p.dataset.tagid)
                                        temp.addEventListener('click', () => {
                                            $.ajax({
                                                url: 'remove-tag.php',
                                                type: 'post',
                                                data: {
                                                    tagid: temp.dataset.tagid,
                                                    blogid: <?= $blogid ?>
                                                },
                                                success: () => {
                                                    temp.parentElement.removeChild(temp);
                                                },
                                            })
                                        })
                                        existingTags.appendChild(temp)
                                    }
                                })
                            })
                            searchResult.appendChild(p)
                        })
                    }
                })
                searchResult.classList.add('show')
            } else {
                searchResult.classList.remove('show')
            }
        })
    </script>
</body>

</html>