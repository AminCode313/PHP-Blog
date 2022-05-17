<?php

global $pdo;

if (isset($_SESSION['user'])) {
    $query = 'SELECT * FROM users WHERE email = ?';
    $statement = $pdo->prepare($query);
    $statement->execute([$_SESSION['user']]);
    $user = $statement->fetch();
}
?>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center
          justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?= url('/') ?>"><img src="<?= asset('/assets/images/logo.svg') ?>" class="mr-2" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center
          justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown" id="profileDropdown">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <span class="mr-2"><?= $user->first_name ?></span>
                    <?php } ?>
                    <img src="<?= asset('/assets/images/user-profile.jpg') ?>" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <?php
                    if (!isset($_SESSION['user'])) { ?>
                        <a class="dropdown-item" href="<?= url('auth/register.php') ?>">
                            <i class="bi bi-door-open text-primary"></i>
                            Register
                        </a>
                        <a class="dropdown-item" href="<?= url('auth/login.php') ?>">
                            <i class="bi bi-box-arrow-in-right text-primary"></i>
                            Login
                        </a>

                    <?php } else { ?>
                        <a class="dropdown-item" href="<?= url('admin') ?>">
                            <i class="bi bi-person text-primary"></i>
                            Admin panel
                        </a>
                        <a class="dropdown-item" href="<?= url('auth/logout.php') ?>">
                            <i class="bi bi-power text-primary"></i>
                            Logout
                        </a>
                    <?php } ?>
                </div>
            </li>

        </ul>
    </div>
</nav>