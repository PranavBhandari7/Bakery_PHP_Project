<?php
    require_once("includes/sessionstatus.php");
    include("includes/config.php");
    
    $id = $_GET['id'];

    $result = mysqli_query($conn, "DELETE FROM categories WHERE category_id=$id");

    echo "<script>location.href='categories.php'</script>";
?>