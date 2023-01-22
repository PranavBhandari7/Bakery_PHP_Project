<?php  require_once("includes/sessionstatus.php"); ?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include('includes/adminHead.php') ?>
<!-- End Head -->

<body>

    <!-- Logged in start -->
    <div class="container register_form">
        <div class="row">
            <div class=" py-4 text-center col-md-12"></div>
            <div class="col-md-12 py-2 text-center" style="background-color:white; border:1px solid black; 
            border-color: black; font-size:1.4rem">
              You are logged in!!
              <br>
              <i class="fa-solid fa-arrow-right-from-bracket mt-5" style="font-size:7rem; color:black"></i>
              <br>
              <div class="mt-4">
              <a href="index.php" class="btn btn-success me-2">Back</a>
              <a href="logout.php" onclick='return confirmLogout()'><button type='submit' class='btn btn-primary' name="logout">
              Logout</button></a>
              </div>
            </div>
        </div>
    </div>
    <!-- Logged in end -->

</body>
<script>
    function confirmLogout() 
    {
      return confirm('Are you sure you want to logout?');
    }
</script>
</html>