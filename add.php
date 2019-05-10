<?php
require 'helpers.php';
require 'functions.php';

$con = mysqli_connect("localhost", "root", "", "yeticave");
    $sql = "SELECT name FROM category;";
    $result = mysqli_query($con, $sql);
    if (!$result){
        $error = mysqli_error($con);
        print("ошибка MySQL:" . $error);
        die();
    }
    $categories_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
//    var_dump($_POST);
    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    foreach ($required_fields as $field){
        if (empty($_POST[$field])){
            $errors[$field] = "Поле необходимо заполнить";
//            var_dump( '$errors'.$errors[$field]);
        }
    }
    $errors['lot-rate'] = 'Начальная цена должна быть больше 0';
    $errors['lot-step'] = 'Шаг ставки должен быть целым числом больше ноля';
    $errors['lot-date'] = 'Введите корректную дату завершения торгов';

    $checkedDate = $_POST['lot-date'];

    $isDateValid = isValidDate($checkedDate);

//var_dump(isValidDate("2018-01-01")); // bool(true) var_dump(isValidDate("2018-1-1")); // bool(true) var_dump(isValidDate("2018-02-28")); // bool(true) var_dump(isValidDate("2018-02-30")); // bool(false)

//    echo('00$dateResult'.$dateResult);

    if (count($errors)){
        echo('ошибка валидации');
        $layout = include_template('layout_add.php', [
            'categories_list' => $categories_list,
            'errors' => $errors,
            'isDateValid' => $isDateValid
        ]);
    }
    else {
        echo('готов записать в бд');
    }



print($layout);
?>