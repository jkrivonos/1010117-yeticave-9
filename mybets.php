<?php
require 'connection.php';
require 'helpers.php';
require 'functions.php';

$con = connectionToBD();
session_start();
$sql = "SELECT name, code FROM category";
$result = mysqli_query($con, $sql);
if (!$result){
    $error = mysqli_error($con);
    print("ошибка MySQL:" . $error);
    die();
}
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $content = include_template('mybets.php', [
        ]);
        $user_name = isset($_SESSION['user']) ? $_SESSION['user']['name'] : '';
        $layout= include_template('layout.php',[
            'content' => $content,
            'title' => 'Мои ставки',
            'user_name' => $user_name,
            'categories' => $categories
        ]);
        print($layout);
?>


