<?php
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';

session_start();

$error = '';

if (
    isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
) {
    global $pdo;
    $query = 'SELECT * FROM users WHERE email = ?';
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['email']]);
    $user = $statement->fetch();
    if ($user !== false) {
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['user'] = $user->email;
            redirect('admin');
        } else {
            $error = 'Password is incorrect!';
        }
    } else {
        $error = 'The email is incorrect!';
    }
} else {
    $error = 'Filling all fields is compulsory!';
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
    <link rel="stylesheet" href="<?= asset('assets/css/ti-icon/css/themify-icon.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap-icons.css') ?>">
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-sm-10 col-md-7 col-lg-4 mx-auto">
                        <?php if ($error !== '' && !empty($_POST)) { ?>
                            <div class="bg-inverse-danger text-left py-4 px-4 px-sm-5 rounded-lg border border-danger mb-3">
                                <p class="text-danger mb-0"><?= $error ?></p>
                            </div>
                        <?php } ?>
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 rounded-lg">
                            <h4 class="text-center font-weight-bold mb-4">Blog with PHP</h4>
                            <form class="pt-3" method="post">
                                <div class="mb-2 ml-2">
                                    <!-- <small class="text-danger">Email</small> -->
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control rounded-lg" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control rounded-lg" name="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary font-weight-medium auth-form-btn">Login</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Have you registered before? <a href="register.php" class="text-primary">SIGN UP</a>
                                </div>
                            </form>
                        </div>
                        <div class="text-center mt-4 font-weight-light">
                            <a href="<?= url('/') ?>" class="text-primary">Open Blog <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= asset('assets/js/vendor.bundle.base.js') ?>"></script>
    <script src="<?= asset('assets/js/hoverable-collapse.js') ?>"></script>
</body>

</html>