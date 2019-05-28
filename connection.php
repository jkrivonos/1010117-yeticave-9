<?php function connectionToBD(){
    $con = mysqli_connect("localhost", "root", "", "yeticave");
    mysqli_set_charset($con, "utf8");

    if ($con == false){
        print("Ошибка подключения: " . mysqli_connect_error());
        die();
    }
    return $con;
}?>