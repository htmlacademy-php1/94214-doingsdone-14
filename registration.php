<?php
require_once('init.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {        
    $errors['email'] = is_filled('email');
    if (!is_filled('email')) {
        $errors['email'] = check_email($connect, $_POST['email']);
    }
    $errors['password'] = is_filled('password');
    $errors['name'] = is_filled('name');

    if (empty($errors['email']) && empty($errors['password']) && empty($errors['name'])) {
        add_new_user($connect, $_POST['email'], $_POST['password'], $_POST['name']);
        header('Location: /index.php');
        exit();
    }
};

$page_content_data = [
    'errors' => $errors
];
$page_content = include_template('register.php', $page_content_data);

$layout_content_data = [
    'page_content' => $page_content,
    'user_name' => get_user_name($connect, $user_id), // я так понимаю, что после следующего задания с авторизацией это можно будет наконец-то выпилить, но пока ещё пусть будет
    'page_name' => 'Регистрация аккаунта'    
];
$layout_content = include_template('layout.php', $layout_content_data);

print($layout_content);