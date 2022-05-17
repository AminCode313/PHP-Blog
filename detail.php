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
    <link rel="stylesheet" href="<?= asset('assets/css/detail-posts.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap-icons.css') ?>">
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- start navbar -->
        <?php require_once 'layouts/top-nav.php' ?>
        <!-- end navbar -->
        <div class="container-fluid page-body-wrapper">
            <div class="content-wrapper d-flex flex-column align-items-center">
                <!-- start main -->
                <?php
                global $pdo;
                $query = "SELECT posts.*, categories.name AS category_name FROM posts JOIN categories ON posts.cat_id = categories.id WHERE posts.status = 1 AND posts.id = ?;";
                $statement = $pdo->prepare($query);
                $statement->execute([$_GET['post_id']]);
                $post = $statement->fetch();

                if ($post !== false) {
                ?>
                    <div class="img-panel overflow-hidden" style="background-image: url(<?= asset($post->image) ?>);">
                    </div>
                    <div class="col-md-auto detail-title">
                        <h1><?= $post->title ?></h1>
                        <div class="mt-3 title-foot">
                            <span><?= $post->category_name ?></span>
                            <span class="ml-5"><?= $post->created_at ?></span>
                        </div>
                    </div>
                    <div class="col-md-10 detail-body">
                        <?= $post->body ?>
                    </div>
                <?php } else { ?>
                    <span class="mt-5 display-3 font-weight-bold text-center text-primary">There is no such post!</span>
                <?php } ?>
                <!-- end main -->
            </div>
            <!-- </div> -->
        </div>
        <script src="<?= asset('assets/js/vendor.bundle.base.js') ?>"></script>
        <script src="<?= asset('assets/js/hoverable-collapse.js') ?>"></script>
</body>

</html>