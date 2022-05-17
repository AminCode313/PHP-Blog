<?php

global $pdo;

$query = 'SELECT * FROM users WHERE email = ?';
$statement = $pdo->prepare($query);
$statement->execute([$_SESSION['user']]);
$user = $statement->fetch();

?>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center
          justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?= url('/') ?>"><img src="<?= asset('/assets/images/logo.svg') ?>" class="mr-2" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center
          justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="icon-bell mx-0"></i>
                    <span class="count"></span>
                </a>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown" id="profileDropdown">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <span class="mr-2"><?= $user->first_name ?></span>
                    <?php } ?>
                    <img src="<?= asset('/assets/images/user-profile.jpg') ?>" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="<?= url('auth/logout.php') ?>">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>