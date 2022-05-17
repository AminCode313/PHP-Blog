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
                        <h3 class="font-weight-bold">Blog</h3>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuSizeButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton2">
                                <h6 class="dropdown-header">Category</h6>
                                <?php
                                global $pdo;
                                $query = "SELECT * FROM categories";
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $posts = $statement->fetchAll();
                                foreach ($posts as $category) {
                                ?>
                                    <a class="dropdown-item" href="<?= url('category.php?cat_id=') . $category->id ?>"><?= $category->name ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start posts -->
                <div class="container">
                    <?php
                    $query = "SELECT posts.*, categories.name AS Category_name FROM posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE status = 1";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $posts = $statement->fetchAll();
                    foreach ($posts as $post) {
                    ?>
                        <div class="card">
                            <img src="<?= asset($post->image) ?>" alt="card__image" class="card__image" width="600">
                            <span class="tag tag-red"><?= $post->Category_name ?></span>
                            <!-- </div> -->
                            <div class="card__body">
                                <h4><?= $post->title ?></h4>
                                <p class="text-justify mt-2"><?= substr($post->body, 0, 145) ?> ...</p>
                                <a href="<?= url('detail.php?post_id=') . $post->id ?>" class="btn btn-primary btn-sm mt-2 stretched-link" style="width: 40%;">Read more...</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- end posts -->
                <!-- end main -->
            </div>
        </div>
        <script src="<?= asset('assets/js/vendor.bundle.base.js') ?>"></script>
        <script src="<?= asset('assets/js/hoverable-collapse.js') ?>"></script>
</body>

</html>