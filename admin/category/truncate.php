<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';

global $pdo;
$query = 'TRUNCATE TABLE `categories`';
$statement = $pdo->prepare($query);
$statement->execute();
redirect('admin/category');
