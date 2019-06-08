<?php
require 'connection.php';
require_once 'helpers.php';
require_once 'functions.php';


$user_name = '';

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
};
if (!empty ($_POST['email'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $res = mysqli_query($con, $sql);

    $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

    if (!count($errors) and $user) {
        if (password_verify($_POST['password'], $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
//            var_dump($_SESSION);
            header("Location: /index.php");
            exit();
        }
        else {
            $errors['password'] = 'Неверный пароль';
        }
    }
    else {
        $errors['email'] = 'Такой пользователь не найден';
    };
}
$content = include_template('login.php', [
    'errors' => $errors
]);

$layout = include_template('layout.php', [
    'content' => $content,
    'categories' => $categories_list,
    'title' => 'Вход',
    'user_name' => ''
]);
print($layout);
?>

