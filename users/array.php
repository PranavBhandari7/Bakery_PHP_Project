<?php
    session_start();

    if(isset($_SESSION["shopping_cart"]))
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
        echo "<pre>";
        print_r($values);
        echo "</pre>";
    }
?>