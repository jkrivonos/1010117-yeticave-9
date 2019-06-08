<?php
require 'connection.php';
require_once 'helpers.php';
require_once 'functions.php';


$con = connectionToBD();
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /");
    http_response_code(403);
    echo('Авторизуйтесь, чтобы добавить лот');
    exit();
}
$sql = "SELECT name, id FROM category;";
$result = mysqli_query($con, $sql);
if (!$result) {
    $error = mysqli_error($con);
    print("ошибка MySQL:" . $error);
    die();
}
$categories_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
$formData = $_POST;
$errors = [];
if (!empty($formData)) {
    $required_fields = ['lot-name', 'message'];
    foreach ($required_fields as $field) {
        if (empty($formData[$field])) {
            $errors[$field] = "Поле необходимо заполнить";
        };
    };

    if (empty($formData['category']) || $formData['category'] === "Выберите категорию") {
        $errors['category'] = "Необходимо выбрать категорию";
    } else {
        $tempCatId = intval($formData['category']);
        $sqlCategory = "SELECT name FROM category where id = $tempCatId;";
        $resultCatName = mysqli_query($con, $sqlCategory);
        $catName = mysqli_fetch_all($resultCatName, MYSQLI_ASSOC);
        if (!$catName) {
            $error = mysqli_error($con);
            $errors['category'] = "Указана неверная категория";
        }
    }

    if (empty($formData['lot-rate'])) {
        $errors['lot-rate'] = "Поле необходимо заполнить";
    } else if (!is_numeric($formData['lot-rate'])) {
        $errors['lot-rate'] = "Некорректное значение";
    } else if ($formData['lot-rate'] <= 0) {
        $errors['lot-rate'] = "Укажите число больше 0";
    }

    if (empty($formData['lot-step'])) {
        $errors['lot-step'] = "Поле необходимо заполнить";
    } else if (!ctype_digit($formData['lot-step'])) {
        $errors['lot-step'] = "Некорректное значение";
    }

    $tomorrowDate = new DateTime('tomorrow');
    if (empty($formData['lot-date'])) {
        $errors['lot-date'] = "Поле необходимо заполнить";
    } else if (!is_date_valid($formData['lot-date'])) {
        $errors['lot-date'] = "Некорректный формат даты";
    } else if ($formData['lot-date'] < $tomorrowDate->format('Y-m-d')) {
        $errors['lot-date'] = 'Дата окончания должна превышать текущую дату';
    };

    if (empty($_FILES['img_lot']['name'])) {
        $errors['file'] = 'Вы не загрузили файл';
    } else {
        $tmp_name = $_FILES['img_lot']['tmp_name'];
        $file_name = $_FILES['img_lot']['name'];
        $file_type = $tmp_name != '' ? mime_content_type($tmp_name) : '';
        if ($file_type !== "image/jpg" and $file_type !== "image/jpeg" and $file_type !== "image/png") {
            $errors['file'] = 'Неверный формат. Загрузите картинку в формате jpg, jpeg, png';
        }
    }

    if (!count($errors)) {
        // Поле для загрузки файла в форме называется 'img_lot', поэтому нам следует искать в массиве $_FILES одноименный ключ.
        // Если таковой найден, то мы можем получить имя загруженного файла.
        $tmp_name = $_FILES['img_lot']['tmp_name'];
        $file_name = $_FILES['img_lot']['name'];
        $file_extantion = substr($file_name, strrpos($file_name, '.') + 1);
        $filename = uniqid() . "." . $file_extantion;
        $path = 'uploads/' . $filename;
        move_uploaded_file($tmp_name, 'uploads/' . $filename);
        $sql = 'INSERT INTO lot (description, title, creation_date, start_price, expiration_date, delta_bet, img_link, user_id, category_id) VALUES (?, ?, NOW(), ?, ?, ?, ?, 1, ?)';
        $stmt = db_get_prepare_stmt($con, $sql, [
            htmlspecialchars($formData['message']),
            htmlspecialchars($formData['lot-name']),
            intval($formData['lot-rate']),
            $formData['lot-date'],
            intval($formData['lot-step']),
            $path,
            htmlspecialchars($formData['category'])
        ]);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            $lot_id = intval(mysqli_insert_id($con));
            header("Location: lot.php?id=" . $lot_id);
            die();
        } else {
            http_response_code(500);
            echo('Непредвиденная ошибка');
        }
    };
}
$user_name = isset($_SESSION['user']) ? $_SESSION['user']['name'] : '';

$content = include_template('add.php', [
    'formData' => $formData,
    'errors' => $errors,
    'categories_list' => $categories_list
]);
$layout = include_template('layout.php', [
    'content' => $content,
    'title' => 'Добавить лот',
    'user_name' => $user_name,
    'categories' => $categories_list
]);
print($layout);
?>

