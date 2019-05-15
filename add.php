<?php
require 'connection.php';
require_once 'helpers.php';
require_once 'functions.php';

connectionToBD();

$sql = "SELECT name FROM category;";
$result = mysqli_query($con, $sql);
if (!$result) {
    $error = mysqli_error($con);
    print("ошибка MySQL:" . $error);
    die();
}
$categories_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $formData = $_POST;
    $required_fields = ['lot-name', 'message', 'lot-date'];
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($formData[$field])) {
            $errors[$field] = "Поле необходимо заполнить";
        };
    };

    if(empty($formData['category']) || $formData['category'] === "Выберите категорию") {
        $errors['category'] = "Необходимо выбрать категорию";
    }

    if(empty($formData['lot-rate'])) {
        $errors['lot-rate'] = "Поле необходимо заполнить";
    } else if (!is_numeric($formData['lot-rate'])) {
        $errors['lot-rate'] = "Некорректное значение";
    } else if ($formData['lot-rate'] < 0) {
        $errors['lot-rate'] = "Укажите положительное число";
    }

    if(empty($formData['lot-step'])) {
        $errors['lot-step'] = "Поле необходимо заполнить";
    } else if (!ctype_digit($formData['lot-step'])) {
        $errors['lot-step'] = "Некорректное значение";
    }


    $checkedDate = count($formData) == 0 ? '' : $formData['lot-date'];
//Проверим, был ли загружен файл.
// Поле для загрузки файла в форме называется 'img_lot', поэтому нам следует искать в массиве $_FILES одноименный ключ.
// Если таковой найден, то мы можем получить имя загруженного файла.

    if (isset($_FILES['img_lot']['name'])) {
        $tmp_name = $_FILES['img_lot']['tmp_name'];
//      С помощью mime_content_type можно получить информацию о типе файле; определяем его расширение
        $file_name = $_FILES['img_lot']['name'];
        $file_extantion = substr($file_name, strrpos($file_name, '.') + 1);
        $file_type = $tmp_name != '' ? mime_content_type($tmp_name) : '';
        if ($file_type !== "image/jpg" and $file_type !== "image/jpeg" and $file_type !== "image/png") {
            $errors['file'] = 'Неверный формат. Загрузите картинку в формате jpg, jpeg, png';
        } else {
//          Если файл соответствует ожидаемому типу, то мы копируем его в директорию где лежат все картинки,
//          а также добавляем путь к загруженной картинки в массив $formData
            $filename =  uniqid() . "." . "$file_extantion";
            $path = 'uploads/' . $filename;
            move_uploaded_file($tmp_name, 'uploads/' . $filename);
            $userIDRandom = '5';
            $categoryNameDB = $formData['category'];
            $sqlIDCategory = 'SELECT id FROM category WHERE name = "' . $categoryNameDB . '"';
            $resultIDCategory = mysqli_query($con, $sqlIDCategory);
            if (!$resultIDCategory) {
                $error = mysqli_error($con);
                print("ошибка MySQL:" . $error);
                die();
            } else {
                $idCategory = mysqli_fetch_assoc($resultIDCategory);
            }
            $sql = 'INSERT INTO lot (description, title, creation_date, start_price, expiration_date, delta_bet, img_link, user_id, category_id) VALUES (?, ?, NOW(), ?, ?, ?, ?, 1, ?)';
            $stmt = db_get_prepare_stmt($con, $sql, [
                $formData['message'],
                $formData['lot-name'],
                $formData['lot-rate'],
                $formData['lot-date'],
                $formData['lot-step'],
                $path,
                $idCategory['id']
            ]);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                $lot_id = mysqli_insert_id($con);
                header("Location: lot.php?id=" . $lot_id);
            } else {
            }
        }
    } else {
        echo('файла нет');
        $errors['file'] = 'Вы не загрузили файл';
    }
    $isDateValid = isValidDate($checkedDate);
$isDateValid = is_date_valid($checkedDate);


    if (count($errors)) {
        echo('ошибка валидации');
        $layout = include_template('layout_add.php', [
            'formData' => $formData,
            'categories_list' => $categories_list,
            'errors' => $errors,
            'isDateValid' => $isDateValid
        ]);
    } else {
        $layout = include_template('layout_add.php', [
            'formData' => $formData,
            'categories_list' => $categories_list,
            'errors' => $errors,
            'isDateValid' => $isDateValid
        ]);
    }

print($layout);
?>