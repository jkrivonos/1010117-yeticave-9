<?php

require 'connection.php';
require 'functions.php';
require 'helpers.php';

    connectionToBD();

    $sql = "SELECT name, code FROM category";
    $result = mysqli_query($con, $sql);
    if (!$result){
        $error = mysqli_error($con);
        print("ошибка MySQL:" . $error);
        die();
    }
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sqlLots = "SELECT
        lot.id,
        lot.title,
        lot.description,
        lot.start_price,
        lot.creation_date,
        lot.img_link,
        lot.expiration_date,
        category.name as category_name,
        IFNULL( MAX(bet.price), lot.start_price) as max_price
        FROM
        lot INNER JOIN category ON lot.category_id = category.id
        LEFT JOIN bet ON lot.id = bet.lot_id WHERE lot.expiration_date > NOW() GROUP BY lot.id
        ORDER BY lot.creation_date DESC;
";
    $resultLots = mysqli_query($con, $sqlLots);
    if (!$resultLots){
        $error = mysqli_error($con);
        print("ошибка MySQL:" . $error);
        die();
    }

    $advertisements = mysqli_fetch_all($resultLots, MYSQLI_ASSOC);


$is_auth = rand(0, 1);
$user_name = 'Юлия';

$content = include_template('index.php', [
    'advertisements' => $advertisements,
    'categories' => $categories
]);

$layout = include_template('layout.php', [
    'content' => $content,
    'categories' => $categories,
    'title' => 'Главная',
    'user_name' => $user_name,
    'is_auth' => $is_auth
]);

print($layout);
?>
