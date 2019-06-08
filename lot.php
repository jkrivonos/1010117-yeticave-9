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

//Минимальная ставка должна быть равна текущей цене плюс шаг торгов.
if (isset($_GET['id'])){
    $id_lot = intval($_GET['id']);
    $sql = "SELECT 
              lot.description, 
              lot.img_link, 
              lot.title, 
              category.name as category_name, 
              IFNULL( MAX(bet.price), lot.start_price) as cur_price, 
              IFNULL( MAX(bet.price) + lot.delta_bet, lot.start_price) as min_betprice 
            FROM 
              lot 
            INNER JOIN category ON 
              lot.category_id = category.id  
            LEFT JOIN bet ON 
              lot.id = bet.lot_id  
            WHERE 
              lot.id = $id_lot 
            GROUP BY 
              lot.id";
    $result = mysqli_query($con, $sql);

    if (!$result){
        $error = mysqli_error($con);
        print("ошибка MySQL:" . $error);
        die();
    }
    $row_cnt = mysqli_num_rows($result);
    if($row_cnt > 0){
        $current_lot = mysqli_fetch_assoc($result);
        $content = include_template('lot.php', [
            'current_lot' => $current_lot
        ]);
        $user_name = isset($_SESSION) ? $_SESSION['username']['name'] : '';
        $layout= include_template('layout.php',[
            'content' => $content,
            'title' => 'Главная',
            'user_name' => $user_name,
            'categories' => $categories
        ]);
        print($layout);
    }else{
        $error = mysqli_error($con);
        http_response_code(404);
        echo('ошибка 404');
    }
} else{
        http_response_code(404);
} ?>


