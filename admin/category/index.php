<?php require_once '../../functions/helpers.php';
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
                                    <h3 class="font-weight-bold">Categories</h3>
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
                                        <form action="<?= url('admin/category/create.php') ?>" method="post">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-primary btn-input-group-text" disabled>New Category :</button>
                                                </div>
                                                <input type="text" class="form-control" name="name" placeholder="category name">
                                                <span class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Create</button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <p class="text-danger mb-0">
                                            Attention! Clicking this button will delete all your categories <i class="icon-arrow-right"></i>
                                            <a href="<?= url('admin/category/truncate.php') ?>" type="button" class="btn btn-danger btn-icon-text ml-2">
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
                                                    <th>Category Name</th>
                                                    <th>Creation time</th>
                                                    <th>Update time</th>
                                                    <th>Setting</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                global $pdo;
                                                $query = "SELECT * FROM categories";
                                                $statement = $pdo->prepare($query);
                                                $statement->execute();
                                                $categories = $statement->fetchAll();
                                                // dd($categories);
                                                foreach ($categories as $category) {
                                                ?>
                                                    <tr>
                                                        <td><?= $category->id ?></td>
                                                        <td><?= $category->name ?></td>
                                                        <td class="text-success"><?= $category->created_at ?></td>
                                                        <td class="text-warning"><?php if (is_null($category->updated_at)) {
                                                                                        echo "Not Updated";
                                                                                    } else {
                                                                                        echo $category->updated_at;
                                                                                    } ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= url('admin/category/delete.php?cat_id=' . $category->id) ?>" type="button" class="btn btn-danger btn-icon-text mr-2">
                                                                <i class="ti-trash btn-icon-prepend"></i>
                                                                Delete
                                                            </a>
                                                            <a href="<?= url('admin/category/edit.php?cat_id=' . $category->id) ?>" type="button" class="btn btn-info btn-icon-text">
                                                                <i class="ti-reload btn-icon-prepend"></i>
                                                                Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
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