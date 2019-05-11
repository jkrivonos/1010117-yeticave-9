<?php
require_once 'helpers.php';
require_once 'functions.php';

$con = mysqli_connect("localhost", "root", "", "yeticave");
    $sql = "SELECT name FROM category;";
    $result = mysqli_query($con, $sql);
    if (!$result){
        $error = mysqli_error($con);
        print("ошибка MySQL:" . $error);
        die();
    }
    $categories_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $formData = $_POST;
        $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
        $errors = [];

        foreach ($required_fields as $field){
            if (empty($formData[$field])){
                $errors[$field] = "Поле необходимо заполнить";
            };
        };
        $checkedDate =  count($formData) == 0 ?  '' : $formData['lot-date'];
//Проверим, был ли загружен файл.
// Поле для загрузки файла в форме называется 'img_lot', поэтому нам следует искать в массиве $_FILES одноименный ключ.
// Если таковой найден, то мы можем получить имя загруженного файла.

        if (isset($_FILES['img_lot']['name'])){
            $tmp_name = $_FILES['img_lot']['tmp_name'];
            $path = $_FILES['img_lot']['name'];

//      С помощью mime_content_type можно получить информацию о типе файле
            $file_type = $tmp_name != '' ? mime_content_type($tmp_name) : '';
            if ($file_type !=="image/jpg" and $file_type !== "image/jpeg" and $file_type !== "image/png"){
                $errors['file'] = 'Неверный формат. Загрузите картинку в формате jpg, jpeg, png';
            }
            else{
//          Если файл соответствует ожидаемому типу, то мы копируем его в директорию где лежат все картинки,
//          а также добавляем путь к загруженной картинки в массив $formData
                move_uploaded_file($tmp_name, 'uploads/'.$path);
                $formData['path'] = $path;
//                $lot = $_POST['lot'];
                var_dump($formData);
                    $userIDRandom = '5';
                $categoryNameDB = $formData['category'];
                echo($categoryNameDB);
                $sqlIDCategory = 'SELECT id FROM category WHERE name = "$categoryNameDB"';
                $resultIDCategory = mysqli_query($con, $sqlIDCategory);
                if (!$resultIDCategory){
                    $error = mysqli_error($con);
                    print("ошибка MySQL:" . $error);
                    die();
                }
                else{
//                    TODO: попытка вытащить id категории не очень удачная..
                    var_dump($resultIDCategory);
                    $idCategory = mysqli_fetch_assoc($resultIDCategory);
                    var_dump($idCategory);

                }

                    $sql = 'INSERT INTO lot (description, title, creation_date, start_price, expiration_date, delta_bet, img_link, user_id) VALUES (?, ?, NOW(), ?, ?, ?, ?, 1)';
                    $stmt = db_get_prepare_stmt($con, $sql, [
                        $formData['message'],
                        $formData['lot-name'],
                        $formData['lot-rate'],
                        $formData['lot-date'],
                        $formData['lot-step'],
                        $formData['path']
                ]);
                    $result = mysqli_stmt_execute($stmt);
                    var_dump($result);
                    if ($result){
                        echo('добавлено в БД');
                    }else{
                        echo('не добавлено!');
                    }
            }
        }else{
            echo('файла нет');
            $errors['file'] = 'Вы не загрузили файл';
        }
        $isDateValid = isValidDate($checkedDate);

        if (count($errors)){
//            var_dump($errors);

            echo('ошибка валидации');
            $layout = include_template('layout_add.php', [
                'formData' => $formData,
                'categories_list' => $categories_list,
                'errors' => $errors,
                'isDateValid' => $isDateValid
            ]);
        }
        else {
            echo('готов записать в бд');
//        $layout = include_template('view.php', ['categories_list' => $categories_list]);
            $layout = include_template('layout_add.php', [
                'formData' => $formData,
                'categories_list' => $categories_list,
                'errors' => $errors,
                'isDateValid' => $isDateValid
            ]);
            var_dump('===>');
            var_dump($_POST);
//            $lot = $formData['img_lot'];
//            var_dump($lot);
//            $filename = uniqid().'.png';
//            var_dump($filename);
//            $lot['path'] = $filename;
        }
    }
    else{
        $layout = include_template('layout_add.php', []);
    }

print($layout);
?>