<?php

require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';
require_once("../../assets/library/jdf.php");
date_default_timezone_set("Asia/Tehran");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= asset('assets/css/feather/feather.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/ti-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body style="-moz-user-select: none;">
    <div class="container-scroller">
        <!-- start navbar -->
        <?php require_once '../layout/top-nav.php' ?>
        <!-- end navbar -->
        <div class="container-fluid page-body-wrapper">
            <!-- start sidebar -->
            <?php require_once '../layout/sidebar.php' ?>
            <!-- end sidebar -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- start main -->
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Posts</h3>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <div class="btn btn-sm btn-light bg-white" type="button">
                                                <?= jdate("Y / m / d") ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <p class="text-success mb-0">
                                            You can add a new post to your list by clicking this button <i class="icon-arrow-right"></i>
                                            <a href="<?= url('admin/post/create.php') ?>" type="button" class="btn btn-success btn-icon-text ml-2">
                                                Create Post
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <p class="text-danger mb-0">
                                            Attention! Clicking this button will delete all your posts <i class="icon-arrow-right"></i>
                                            <a href="<?= url('admin/post/truncate.php') ?>" type="button" class="btn btn-danger btn-icon-text ml-2">
                                                Truncate
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Category Name</th>
                                                    <th>Body</th>
                                                    <th>Status</th>
                                                    <th>Setting</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                global $pdo;
                                                $query = "SELECT posts.*, categories.name AS Category_name FROM posts LEFT JOIN categories ON posts.cat_id = categories.id ";
                                                $statement = $pdo->prepare($query);
                                                $statement->execute();
                                                $posts = $statement->fetchAll();
                                                foreach ($posts as $post) {
                                                ?>
                                                    <tr>
                                                        <td><?= $post->id ?></td>
                                                        <td>
                                                            <img src="<?= asset($post->image); ?>" alt="">
                                                        </td>
                                                        <td><?php if (strlen($post->title) > 18) { ?>
                                                              <?=  substr($post->title, 0, 18) . ' ...'?>
                                                        <?php }else{ ?><?=$post->title?><?php } ?></td>
                                                        <td><?php if (is_null($post->Category_name)) { ?>
                                                                <span class="text-warning"><?= "Not Category" ?></span><?php
                                                                                                                    } else {
                                                                                                                        echo $post->Category_name;
                                                                                                                    } ?>
                                                        </td>
                                                        <td><?= substr($post->body, 0, 30) . " ..." ?></td>
                                                        <td>
                                                            <?php
                                                            if ($post->status == 1) { ?>
                                                                <span class="text-success">Enable</span>
                                                            <?php } else { ?>
                                                                <span class="text-danger">Disable</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= url('admin/post/change-status.php?post_id=' . $post->id) ?>" type="button" class="btn btn-warning btn-icon-text btn-sm mr-1">
                                                                Change status
                                                            </a>
                                                            <a href="<?= url('admin/post/delete.php?post_id=' . $post->id) ?>" type="button" class="btn btn-danger btn-icon-text btn-sm mr-1">
                                                                Delete
                                                            </a>
                                                            <a href="<?= url('admin/post/edit.php?post_id=' . $post->id) ?>" type="button" class="btn btn-info btn-icon-text btn-sm">
                                                                Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end main -->
            </div>
        </div>
        <script src="<?= asset('assets/js/vendor.bundle.base.js') ?>"></script>
        <script src="<?= asset('assets/js/hoverable-collapse.js') ?>"></script>
</body>

</html>