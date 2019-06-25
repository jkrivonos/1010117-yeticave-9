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

$sqlBets = "SELECT bet.creation_time, bet.price, lot.title as lot_name, lot.img_link as betImage FROM bet INNER JOIN lot ON bet.lot_id = lot.id";

//"SELECT bet.price, bet.creation_time FROM lot INNER JOIN bet ON bet.lot_id = lot.id WHERE lot.id = 2 ORDER BY bet.creation_time DESC;"
$resultBets = mysqli_query($con, $sqlBets);
if (!$resultBets){
    $error = mysqli_error($con);
    print("ошибка MySQL:" . $error);
    die();
}
$bets = mysqli_fetch_all($resultBets, MYSQLI_ASSOC);



        $content = include_template('mybets.php', [
            'bets' => $bets
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


