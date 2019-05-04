<?php
require 'connection.php';
require 'helpers.php';
require 'functions.php';

connectionToBD();

$id_lot = intval($_GET['id']);
$sql = "SELECT lot.description, lot.img_link, lot.title, category.name as category_name, IFNULL( MAX(bet.price), lot.start_price) as max_price, IFNULL( MIN(bet.price), 0) as min_betprice FROM lot INNER JOIN category ON lot.category_id = category.id  LEFT JOIN bet ON lot.id = bet.lot_id  WHERE lot.id = $id_lot GROUP BY lot.id";

$result = mysqli_query($con, $sql);

if (!$result){
    $error = mysqli_error($con);
    print("ошибка MySQL:" . $error);
    die();
}
$current_lot = mysqli_fetch_assoc($result);

//$error404 = header("Location: http://yeticave.ru/error.php/");

$layout_lot = include_template('layout_lot.php',[
    'current_lot'=>$current_lot,
     'error404' => $error404
]);
print($layout_lot);
?>