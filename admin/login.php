<?php
    // Start the session
    if(!isset($_SESSION["admin_email"]))
    { 
        session_start();
    }

    require_once("includes/config.php");

    // Check if the user is already logged in
    if(isset($_SESSION["admin_email"]))
    {
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }

    $email = $password = "";
    $err = "";

     // if request method is post
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["email"]) || empty($_POST["password"]))
        {
            $err = "Please enter the username and password";
        }

        else if (isset($_POST['email']) && isset($_POST['password'])) 
        {
            function validate($data)
            {

                $data = trim($data);
            
                $data = stripslashes($data);
            
                $data = htmlspecialchars($data);
            
                return $data;
            }

            $email = validate($_POST["email"]);
            $password = validate($_POST["password"]);
        }

        if(empty($err))
        {
            $sql = "SELECT admin_id, email, password FROM admin WHERE email = ?";
            $stmt = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            // Try to execute the statement
            if(mysqli_stmt_execute(($stmt)))
            {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $user_id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // This means the password is correct Allow user to login
                            // session_start();
                            $_SESSION["admin_id"] = $user_id;
                            $_SESSION["admin_email"] = $email;
                            $_SESSION["admin_loggedin"] = true;

                            echo "<script>window.location.href='index.php';</script>";

                        }
                        else
                        {
                            $err =  "Password does not match";
                        }
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include('includes/adminHead.php') ?>
<!-- End Head -->

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <div class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class=" d-block">Login Here</span>
                </div>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-1">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>
                  <hr>
                  <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" 
                        id="email" placeholder="example@gmail.com">
                      </div>
                      <span class="error">* <?php echo $err;?></span>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" 
                      id="password" placeholder="Please enter the password here">
                      <span class="error">* <?php echo $err;?></span>
                    </div>

                    <div class="col-12 my-4">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php include('includes/js.php') ?>
  <!-- End Vendor JS Files -->

</body>

</html>