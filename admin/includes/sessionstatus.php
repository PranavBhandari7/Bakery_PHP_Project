<?php
    session_start();
    if(!isset($_SESSION['admin_email'])) 
    {
      echo "<script>window.location.href='login.php';</script>";
      exit;
    }
?>