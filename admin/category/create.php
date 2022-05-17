<?php 

require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';


if (isset($_POST['name']) && $_POST['name'] !== '' && !ctype_space($_POST['name'])) {
    global $pdo;
    $noneSpace = trim($_POST['name']);
    $query = 'INSERT INTO categories SET name = ?, created_at = NOW() ;';
    $statement = $pdo->prepare($query);
    $statement->execute([$noneSpace]);
}
redirect('admin/category');