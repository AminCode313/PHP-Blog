<?php require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';
require_once '../functions/check-login.php';
require_once("../assets/library/jdf.php");
date_default_timezone_set("Asia/Tehran");

global $pdo;

$query = 'SELECT * FROM users WHERE email = ?';
$statement = $pdo->prepare($query);
$statement->execute([$_SESSION['user']]);
$user = $statement->fetch();

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

<body>
    <div class="container-scroller">
        <!-- start navbar -->
        <?php require_once '../admin/layout/top-nav.php' ?>
        <!-- end navbar -->
        <div class="container-fluid page-body-wrapper">
            <!-- start sidebar -->
            <?php require_once 'layout/sidebar.php' ?>
            <!-- end sidebar -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- start main -->
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Welcome <?= $user->first_name . ' ' .$user->last_name ?></h3>
                                    <h6 class="font-weight-normal mb-0">The first <span class="text-primary">php blog </span>training project for Mohammad Amin Forati</h6>
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
                </div>
                <!-- end main -->
            </div>
        </div>
        <script src="<?= asset('assets/js/vendor.bundle.base.js') ?>"></script>
        <script src="<?= asset('assets/js/hoverable-collapse.js') ?>"></script>
</body>

</html>