<?php
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';

$error = '';

global $pdo;

if (
    isset($_POST['email']) && $_POST['email'] !== '' &&
    isset($_POST['first_name']) && $_POST['first_name'] !== '' &&
    isset($_POST['last_name']) && $_POST['last_name'] !== '' &&
    isset($_POST['password']) && $_POST['password'] !== '' &&
    isset($_POST['confirm']) && $_POST['confirm'] !== ''
) {

    if ($_POST['password'] === $_POST['confirm']) {
        if (strlen($_POST['password']) >= 8) {
            if (strlen($_POST['first_name']) < 200) {
                if (strlen($_POST['last_name']) < 200) {
                    $query = 'SELECT * FROM users WHERE email = ?';
                    $statement = $pdo->prepare($query);
                    $statement->execute([$_POST['email']]);
                    $user = $statement->fetch();
                    if ($user === false) {
                        $query = 'INSERT INTO users SET email = ?, first_name = ?, last_name = ?, password = ?, created_at = NOW() ;';
                        $statement = $pdo->prepare($query);
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $statement->execute([$_POST['email'], $_POST['first_name'], $_POST['last_name'], $password]);
                        redirect('auth/login.php');
                    } else {
                        $error = 'The logged email is duplicate!';
                    }
                } else {
                    $error = 'Your last name is more than the limit!';
                }
            } else {
                $error = 'Your first name is more than the limit!';
            }
        } else {
            $error = 'Password should not be less than 8 characters!';
        }
    } else {
        $error = 'Password does not match Confirm Password!';
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
    <link rel="stylesheet" href="<?= asset('assets/css/ti-icon/css/themify-icon.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
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
                            <form class="pt-3" action="<?= url('auth/register.php') ?>" method="post">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control rounded-lg" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control rounded-lg" name="first_name" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control rounded-lg" name="last_name" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control rounded-lg" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control rounded-lg" name="confirm" placeholder="Confirm Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary font-weight-medium auth-form-btn">SIGN UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="login.php" class="text-primary">Login</a>
                                </div>
                            </form>
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