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
    $errors['category'] = 'Выберите категорию. Обязательно для заполнения';

    $checkedDate = $_POST['lot-date'];
//
//Проверка изображения
//
//    Обязательно проверять MIME-тип загруженного файла;
//    Допустимые форматы файлов: jpg, jpeg, png;
//    Для проверки сравнивать MIME-тип файла со значением «image/png», «image/jpeg»;
//    Чтобы определить MIME-тип файла, использовать функцию mime_content_type.

    if (isset($_FILES['img_lot']['name'])){
        $tmp_name = $_FILES['img_lot']['tmp_name'];
        $path = $_FILES['img_lot']['name'];
        echo('$path'.$path);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        echo('$file_type'.$file_type);
        if (($file_type !=="image/jpg") OR ($file_type !== "image/jpeg") OR ($file_type !== "image/png")){
            echo('не тот формат');
            $errors['files'] = 'Загрузите картинку в формате jpg, jpeg, png';
        }
        else{
            echo('формат подходит');
            move_uploaded_file($tmp_name, 'uploads/'.$path);
            $_POST['path'] = $path;
        }
    }else{
        $error['file'] = 'Вы не загрузили файл';
    }

    $isDateValid = isValidDate($checkedDate);
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