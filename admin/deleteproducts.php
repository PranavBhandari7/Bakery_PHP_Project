<?php
    require_once("includes/sessionstatus.php");
    include("includes/config.php");

    $id = $_GET['id'];

    $result = mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");
    
    echo "<script>location.href='products.php'</script>";
?>