<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';
require_once("../../assets/library/jdf.php");
date_default_timezone_set("Asia/Tehran");

global $pdo;

if (!isset($_GET['cat_id'])) {
    redirect('admin/category');
}

$query = 'SELECT * FROM categories WHERE id = ?';
$statement = $pdo->prepare($query);
$statement->execute([$_GET['cat_id']]);
$category = $statement->fetch();
if ($category === false) {
    redirect('admin/category');
}

if (isset($_POST['name']) && $_POST['name'] !== '' && !ctype_space($_POST['name'])) {
    $noneSpace = trim($_POST['name']);
    $query = 'UPDATE categories SET name = ?, updated_at = NOW() WHERE id = ? ;';
    $statement = $pdo->prepare($query);
    $statement->execute([$noneSpace, $_GET['cat_id']]);
    redirect('admin/category');
}

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
                                    <h3 class="font-weight-bold">Edit Categories</h3>
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
                                        <form action="<?= url('admin/category/edit.php?cat_id=') . $_GET['cat_id'] ?>" method="post">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-primary btn-input-group-text" disabled>New Name :</button>
                                                </div>
                                                <input type="text" class="form-control" name="name" value="<?= $category->name ?>">
                                                <span class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </span>
                                            </div>
                                        </form>
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