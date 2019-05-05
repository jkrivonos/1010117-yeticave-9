<?php
require_once 'connection.php';
require 'helpers.php';
require 'functions.php';

connectionToBD();

if (!$con){
    $error = mysqli_error();
    header("Location: http://yeticave.ru/error.php/");
    print("ошибка MySQL:" . $error);
    die();
}
$id_lot = intval($_GET['id']);
$sql = "SELECT lot.description, lot.img_link, lot.title, category.name as category_name, IFNULL( MAX(bet.price), lot.start_price) as max_price, IFNULL( MIN(bet.price), 0) as min_betprice FROM lot INNER JOIN category ON lot.category_id = category.id  LEFT JOIN bet ON lot.id = bet.lot_id  WHERE lot.id = $id_lot GROUP BY lot.id";
$result = mysqli_query($con, $sql);

if ($result){
    $current_lot = mysqli_fetch_assoc($result);
} else{
    $error = mysqli_error($con);
    header("Location: http://yeticave.ru/error.php/");
    die();
}

if (count($current_lot) == 0 || !isset($_GET['id'])){
    header("Location: http://yeticave.ru/error.php/");
    die();
};

$layout_lot = include_template('layout_lot.php',[
    'current_lot'=>$current_lot
]);
print($layout_lot);
?>