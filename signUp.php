<?php
require 'connection.php';
require_once 'helpers.php';
require_once 'functions.php';


$is_auth = rand(0, 1);
$user_name = 'Юлия';

$con = connectionToBD();

$sql = "SELECT name, id FROM category;";
$result = mysqli_query($con, $sql);
if (!$result) {
    $error = mysqli_error($con);
    print("ошибка MySQL:" . $error);
    die();
}
$categories_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

$errors = [];

if (!empty($_POST)) {
    if (empty($_POST['email'])) {
        $errors['email'] = "Введите e-mail";
    } else if (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "email невалидный";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Введите пароль";
    }
    if (empty($_POST['name'])) {
        $errors['name'] = "Введите имя";
    }
    if (empty($_POST['message'])) {
        $errors['message'] = "Напишите как с вами связаться";
    }
    if (empty($errors)) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $sql = "SELECT id FROM user WHERE email = '$email'";

        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        } else {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = 'INSERT INTO user (registration_date, email, name, password) VALUES (NOW(), ?, ?, ?)';
            $stmt = db_get_prepare_stmt($con, $sql, [$_POST['email'], $_POST['name'], $password]);
            $res = mysqli_stmt_execute($stmt);
        }
        if ($res && empty($errors)) {
            header("Location: /login.php");
            exit();
        } else {
            http_response_code(500);
            echo('Непредвиденная ошибка');
        }


    }
}
$content = include_template('signUp.php', [
    'errors' => $errors,
    'categories_list' => $categories_list
]);

$layout = include_template('layout.php', [
    'content' => $content,
    'categories' => $categories_list,
    'title' => 'Регистрация',
    'user_name' => $user_name,
    'is_auth' => $is_auth,
]);
print($layout);

?>

