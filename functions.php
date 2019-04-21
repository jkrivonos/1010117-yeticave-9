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
        $nowTime = new DateTime("now");
        $midnightTime = new DateTime("tomorrow midnight");
        $interval = $nowTime->diff($midnightTime);
        if ($interval->format('%h') < 1) {
            echo "<div class='timer--finishing'>".$interval->format('%h : %i')."</div>";
        }else{
            echo "<div class='lot__timer timer'>".$interval->format('%h : %i')."</div>";
        }
    }
    ?>


