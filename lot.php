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
$errors = [];
if (empty($_POST['cost'])) {
    $errors['cost'] = "Поле необходимо заполнить";
} else if (!is_numeric($_POST['cost'])) {
    $errors['cost'] = "Некорректное значение";
} else if ($_POST['cost'] <= 0) {
    $errors['cost'] = "Укажите число больше 0";
}else{
    $sql = 'INSERT INTO bet (user_id, lot_id, creation_time, price) VALUES (?, ?, NOW(), ?)';
    $stmt = db_get_prepare_stmt($con, $sql, [
        intval($_SESSION['user']['id']),
        intval($_GET['id']),
        intval($_POST['cost']),

    ]);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo $result;
//    $lot_id = intval(mysqli_insert_id($con));
//    header("Location: lot.php?id=" . $lot_id);
//    die();
    } else {
        http_response_code(500);
        echo('Непредвиденная ошибка');
    }
}







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
            'current_lot' => $current_lot,
            'errors' => $errors
        ]);
        $user_name = isset($_SESSION['user']) ? $_SESSION['user']['name'] : '';
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


