<?php
    session_start();
    if(!isset($_SESSION['email']) == "admin@gmail.com") 
    {
      echo "<script>window.location.href='login.php';</script>";
      exit;
    }
?>