<?php
function formatPrice($temp)
{
    $formatedPrice = "";
    $tempPrice = ceil($temp);
    if ($tempPrice < 1000) {
        $formatedPrice = $tempPrice . " " . "Р";
    } else {
        $formatedPrice = number_format($tempPrice, 0, '.', ' ') . " " . "Р";
    }
    return $formatedPrice;
}

function formatTime()
{
    if (setlocale(LC_ALL, "0") != "ru_RU") {
        setlocale(LC_ALL, "ru_RU");
    }
    if (date_default_timezone_get() != "Europe/Moscow") {
        date_default_timezone_set("Europe/Moscow");
    }
    $interval = (new DateTime("now"))->diff(new DateTime("tomorrow midnight"));
    if ($interval->format('%h') < 1) {
        echo "<div class='timer--finishing timer'>" . $interval->format('%h : %i') . "</div>";
    } else {
        echo "<div class='lot__timer timer'>" . $interval->format('%h : %i') . "</div>";
    }
}

function isValidDate($date){
    return preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $m) ? checkdate(intval($m[2]), intval($m[3]), intval($m[1])) : false;
}?>