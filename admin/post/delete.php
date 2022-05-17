<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';

global $pdo;

if (isset($_GET['post_id']) and $_GET['post_id'] !== '') {

    $query = 'SELECT * FROM posts WHERE id = ?';
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['post_id']]);
    $post = $statement->fetch();
    $basePath = dirname(dirname(__DIR__));
    if (file_exists($basePath . $post->image)) {
        unlink($basePath . $post->image);
    }
    $queryDel = 'DELETE FROM posts WHERE id = ?';
    $statement = $pdo->prepare($queryDel);
    $statement->execute([$_GET['post_id']]);
}

redirect('admin/post');
