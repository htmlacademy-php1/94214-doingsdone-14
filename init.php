<?php
require_once('helpers.php');
require_once('functions.php');

session_start();
$user_id = 0;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

$show_complete_tasks = rand(0, 1);

$database = require_once('database.php');
$connect = mysqli_connect($database['host'], $database['user'], $database['password'], $database['name']);
mysqli_set_charset($connect, "utf8");

if (!$connect) {
    $error = ['error' => mysqli_connect_error()];
    $page_content = include_template('error.php', $error);
    $layout_content = include_template('layout.php', ['page_content' => $page_content]);
    print($layout_content);
}