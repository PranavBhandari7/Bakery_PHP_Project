<?php
    require_once("includes/sessionstatus.php");
    //including the database connection file
    include("includes/config.php");

    //getting id of the data from url
    $id = $_GET['id'];

    //deleting the row from table
    $result = mysqli_query($conn, "DELETE FROM categories WHERE category_id=$id");

    //redirecting to the display page (index.php in our case)
    echo "<script>location.href='categories.php'</script>";
?>