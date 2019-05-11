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

    $formData = $_POST;
    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date', 'img_lot'];
    $errors = [];

foreach ($required_fields as $field){
    if (empty($formData[$field])){
        $errors[$field] = "Поле необходимо заполнить";
    };
};
        $errors['lot-rate'] = 'Начальная цена должна быть больше 0';
        $errors['lot-step'] = 'Шаг ставки должен быть целым числом больше ноля';
        $errors['lot-date'] = 'Введите корректную дату завершения торгов';
        $errors['category'] = 'Выберите категорию. Обязательно для заполнения';
        $errors['file'] = '';

        $checkedDate =  count($formData) == 0 ?  '' : $formData['lot-date'];

//Проверка изображения
//
//    Обязательно проверять MIME-тип загруженного файла;
//    Допустимые форматы файлов: jpg, jpeg, png;
//    Для проверки сравнивать MIME-тип файла со значением «image/png», «image/jpeg»;
//    Чтобы определить MIME-тип файла, использовать функцию mime_content_type.

//Проверим, был ли загружен файл.
// Поле для загрузки файла в форме называется 'img_lot', поэтому нам следует искать в массиве $_FILES одноименный ключ.
// Если таковой найден, то мы можем получить имя загруженного файла.

    if (isset($_FILES['img_lot']['name'])){
        echo('файл есть');
        $tmp_name = $_FILES['img_lot']['tmp_name'];
        $path = $_FILES['img_lot']['name'];
        var_dump('$path'.'  '.$path);

//      С помощью стандартной функции finfo_ можно получить информацию о типе файле
//        $finfo = finfo_open(FILEINFO_MIME_TYPE);
//        $file_type = finfo_file($finfo, $tmp_name);
        $file_type = mime_content_type($tmp_name);
        if ($file_type !=="image/jpg" and $file_type !== "image/jpeg" and $file_type !== "image/png"){
            echo('не тот формат');
            $errors['file'] = 'Неверный формат. Загрузите картинку в формате jpg, jpeg, png';
        }
        else{
            echo('формат подходит');
//          Если файл соответствует ожидаемому типу, то мы копируем его в директорию где лежат все картинки,
//          а также добавляем путь к загруженной гифки в массив $formData
            move_uploaded_file($tmp_name, 'uploads/'.$path);
            $formData['path'] = $path;
        }
    }else{
        echo('файла нет');
        $errors['file'] = 'Вы не загрузили файл';
    }

    $isDateValid = isValidDate($checkedDate);
    if (count($errors)){
//        echo('ошибка валидации');
        $layout = include_template('layout_add.php', [
            'formData' => $formData,
            'categories_list' => $categories_list,
            'errors' => $errors,
            'isDateValid' => $isDateValid
        ]);
    }
    else {
        echo('готов записать в бд');
        $layout = include_template('view.php', ['categories_list' => $categories_list]);
    }



print($layout);
?>