<?php

    foreach($data['products'] as $ads):
        echo $ads->product_id . " | ";
        echo $ads->product_title ." | ";
        echo $ads->email . " | ";
        echo $ads->product_condition;
        echo "</br>";
    endforeach;


?>