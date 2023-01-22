<?php  require_once("includes/sessionstatus.php"); ?>
<?php
//including the database connection file
include("includes/config.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");

//redirecting to the display page (index.php in our case)
echo "<script>location.href='products.php'</script>";
?>