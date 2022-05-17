<?php require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';
require_once("../../assets/library/jdf.php");
date_default_timezone_set("Asia/Tehran");

global $pdo;

if (!isset($_GET['post_id'])) {
    redirect('admin/post');
}

$query = 'SELECT * FROM posts WHERE id = ?';
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();
if ($post == false) {
    redirect('admin/post');
}


if (
    isset($_POST['title']) && $_POST['title'] !== '' &&
    isset($_POST['cat_id']) && $_POST['cat_id'] !== '' &&
    isset($_POST['body']) && $_POST['body'] !== ''
) {
    $query = 'SELECT * FROM categories WHERE id = ?';
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['cat_id']]);
    $category = $statement->fetch();

    if (isset($_FILES['image']) && $_FILES['image']['name'] !== '') {
        $allowedMimes = ['png', 'jpg', 'jpeg', 'gif'];
        $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (!in_array($imageMime, $allowedMimes)) {
            redirect('admin/post');
        }
        $basePath = dirname(dirname(__DIR__));
        if (file_exists($basePath . $post->image)) {
            unlink($basePath . $post->image);
        }
        $image = '/assets/images/posts/' . date("Y_m_d_H_i_s") . '.' . $imageMime;
        $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);
        if ($category !== false && $image_upload !== false) {
            $query = 'UPDATE posts SET title = ?, cat_id = ?, body = ?, image = ?, image_name = ?, updated_at = NOW() WHERE id = ? ;';
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $image, $_FILES['image']['name'], $_GET['post_id']]);
        }
    } else {
        if ($category !== false) {
            $query = 'UPDATE posts SET title = ?, cat_id = ?, body = ?, updated_at = NOW() WHERE id = ? ;';
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $_GET['post_id']]);
        }
    }
    redirect('admin/post');
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
                                    <h3 class="font-weight-bold">Edit Post</h3>
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

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="<?= url('admin/post/edit.php?post_id=' . $_GET['post_id']) ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="<?= $post->title ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select class="form-control" name="cat_id" id="category">
                                                    <?php
                                                    global $pdo;
                                                    $query = "SELECT * FROM categories";
                                                    $statement = $pdo->prepare($query);
                                                    $statement->execute();
                                                    $categories = $statement->fetchAll();
                                                    foreach ($categories as $category) {
                                                    ?>
                                                        <option value="<?= $category->id ?>" <?php if ($category->id == $post->cat_id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $category->name ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Upload Image</label>
                                                <input type="file" name="image" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled="" value="<?= $post->image_name ?>">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 align-self-center">
                                            <img src="<?= asset($post->image); ?>" style="width: 60px; height: 60px; border-radius: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="text_body">Body</label>
                                        <textarea class="form-control" name="body" id="text_body" rows="4" spellcheck="false" style="line-height: 20px;"><?= $post->body ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                    <a class="btn btn-light" href="<?= asset('admin/post') ?>">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end main -->
            </div>
        </div>
        <script src="<?= asset('assets/js/vendor.bundle.base.js') ?>"></script>
        <script src="<?= asset('assets/js/hoverable-collapse.js') ?>"></script>
        <script src="<?= asset('assets/js/file-upload.js') ?>"></script>
</body>

</html>