<?php
    function formatPrice($temp){
        $formatedPrice = "";
        $tempPrice = ceil($temp);
            if ($tempPrice < 1000){
                $formatedPrice = $tempPrice." "."Р";
            }else{
                $formatedPrice = number_format($tempPrice, 0, '.',' ') ." "."Р";
            }
        return $formatedPrice;
    }

    function formatTime(){
        date_default_timezone_set("Europe/Moscow");
        setlocale(LC_ALL, 'ru_RU');

        $interval = (new DateTime("now")) -> diff(new DateTime("tomorrow midnight"));
        if ($interval->format('%h') < 1) {
            echo "<div class='timer--finishing'>".$interval->format('%h : %i')."</div>";
        }else{
            echo "<div class='lot__timer timer'>".$interval->format('%h : %i')."</div>";
        }
    }

    function isValidDate($date){
        echo('$dateResult'.$date);
        return preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $m) ? checkdate(intval($m[2]), intval($m[3]), intval($m[1])) : false; }
?>
<!---->
<!--Проверка и проверка YYYY-MM-DD в одной строке-->
<!---->
<!--function isValidDate($date) { return preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $date, $m) ? checkdate(intval($m[2]), intval($m[3]), intval($m[1])) : false; }-->
<!---->
<!--Выход будет:-->
<!---->
<!--var_dump(isValidDate("2018-01-01")); // bool(true) var_dump(isValidDate("2018-1-1")); // bool(true) var_dump(isValidDate("2018-02-28")); // bool(true) var_dump(isValidDate("2018-02-30")); // bool(false)-->
<!---->
<!--Допускаются день и месяц без начального нуля. Если вы не хотите разрешать это, регулярное выражение должно быть:-->
<!---->
<!--"/^(\d{4})-(\d{2})-(\d{2})$/" -->

