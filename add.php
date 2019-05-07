<?php
require 'helpers.php';
$con = mysqli_connect("localhost", "root", "", "yeticave");
    $sql = "SELECT name FROM category;";
    $result = mysqli_query($con, $sql);
    if (!$result){
        $error = mysqli_error($con);
        print("ошибка MySQL:" . $error);
        die();
    }
    $categories_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
//    var_dump($categories_list);
$layout = include_template('layout_add.php', [
    'categories_list' => $categories_list
]);


print($layout);
?>