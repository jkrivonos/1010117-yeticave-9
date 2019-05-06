<?php
require 'connection.php';
require 'helpers.php';
require 'functions.php';

$is_auth = rand(0, 1);
$user_name = 'Юлия';

connectionToBD();

if (!$con){
    $error = mysqli_error();
    header("Location: http://yeticave.ru/error.php/");
    print("ошибка MySQL:" . $error);
    die();
}


$sql = "SELECT name, code FROM category";
$result = mysqli_query($con, $sql);
if (!$result){
    $error = mysqli_error($con);
    print("ошибка MySQL:" . $error);
    die();
}
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);


if (isset($_GET['id'])){
    $id_lot = intval($_GET['id']);
    $sql = "SELECT lot.description, 
            lot.img_link, 
            lot.title, 
            category.name as category_name, 
            IFNULL( MAX(bet.price), 
            lot.start_price) as max_price, 
            IFNULL( MIN(bet.price), 0) as min_betprice 
            FROM lot INNER JOIN category ON lot.category_id = category.id  
            LEFT JOIN bet ON lot.id = bet.lot_id  
            WHERE lot.id = $id_lot 
            GROUP BY lot.id";
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
        $layout= include_template('layout.php',[
            'content' => $content,
            'title' => 'Главная',
            'user_name' => $user_name,
            'is_auth' => $is_auth,
            'categories' => $categories
        ]);
        print($layout);
//        print($layout_lot);
    }else{
        $error = mysqli_error($con);
        http_response_code(404);
        echo('ошибка 404');
    }
} else{
        http_response_code(404);
} ?>


