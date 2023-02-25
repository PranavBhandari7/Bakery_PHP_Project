<?php
  session_start();
  if(isset($_SESSION["admin_email"]))
  {
    session_unset();
    session_destroy();
    echo "<script>window.location.href='login.php';</script>";
    exit;
  }
?>