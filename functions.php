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
?>


