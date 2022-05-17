<?php

session_start();

require_once 'functions/helpers.php';
require_once 'functions/pdo_connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="<?= asset('assets/css/feather/feather.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/ti-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/posts.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap-icons.css') ?>">
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body style="-moz-user-select: none;">
    <div class="container-scroller">
        <!-- start navbar -->
        <?php require_once 'layouts/top-nav.php' ?>
        <!-- end navbar -->
        <div class="container-fluid page-body-wrapper">
            <!-- start sidebar -->
            <?php
            ?>
            <!-- end sidebar -->
            <div class="content-wrapper d-flex flex-column align-items-center">
                <!-- start main -->
                <div class="row mx-width">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <?php
                        $notFound = false;
                        if (isset($_GET['cat_id']) && $_GET['cat_id'] !== '') {
                            global $pdo;
                            $query = "SELECT * FROM categories WHERE id = ?";
                            $statement = $pdo->prepare($query);
                            $statement->execute([$_GET['cat_id']]);
                            $category = $statement->fetch();
                            if ($category !== false) {
                        ?>
                                <h3 class="font-weight-bold"><?= $category->name ?></h3>
                                <div class="btn-filter d-flex">
                                    <a class="btn btn-inverse-info mr-3" type="button" id="dropdownMenuSizeButton2" href="<?= url('/') ?>">
                                        Delete Filter <i class="bi bi-x"></i>
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuSizeButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Filter
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton2">
                                            <h6 class="dropdown-header">Category</h6>
                                            <?php
                                            $query = "SELECT * FROM categories";
                                            $statement = $pdo->prepare($query);
                                            $statement->execute();
                                            $posts = $statement->fetchAll();
                                            foreach ($posts as $category) {
                                            ?>
                                                <a class="dropdown-item" href="<?= url('category.php?cat_id=') . $category->id ?>"><?= $category->name ?></a>
                                    <?php }
                                        } else {
                                            $notFound = true;
                                        }
                                    } else {
                                        $notFound = true;
                                    } ?>
                                        </div>
                                    </div>
                                    <?php
                                    if ($notFound) { ?>
                                        <span class="mt-5 display-3 font-weight-bold text-center text-primary">Category not found!</span>
                                    <?php } ?>
                                </div>
                    </div>
                </div>
                <!-- start posts -->
                <?php
                if (!$notFound) { ?>
                    <div class="container">
                        <?php
                        $query = "SELECT * FROM posts WHERE status = 1 AND cat_id = ?;";
                        $statement = $pdo->prepare($query);
                        $statement->execute([$_GET['cat_id']]);
                        $posts = $statement->fetchAll();
                        foreach ($posts as $post) {
                        ?>

                            <div class="card">
                                <img src="<?= asset($post->image) ?>" alt="card__image" class="card__image" width="600">
                                <div class="card__body">
                                    <h4><?= $post->title ?></h4>
                                    <p class="text-justify mt-2"><?= substr($post->body, 0, 145) ?> ...</p>
                                    <a href="<?= url('detail.php?post_id=') . $post->id ?>" class="btn btn-primary btn-sm mt-2 stretched-link" style="width: 40%;">Read more...</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { echo 'hi'; }?>
                <!-- end posts -->
                <!-- end main -->
            </div>
        </div>
        <script src="<?= asset('assets/js/vendor.bundle.base.js') ?>"></script>
        <script src="<?= asset('assets/js/hoverable-collapse.js') ?>"></script>
</body>

</html>