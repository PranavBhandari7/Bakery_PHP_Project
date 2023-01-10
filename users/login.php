<?php
    // Start the session
    if(!isset($_SESSION["email"])){ 
        session_start();
    }

    require_once("include/config.php");

    // Check if the user is already logged in
    if(isset($_SESSION["email"]))
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
            $sql = "SELECT user_id, email, password FROM users WHERE email = ?";
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
                            session_start();
                            $_SESSION["id"] = $user_id;
                            $_SESSION["email"] = $email ;
                            $_SESSION["loggedin"] = true;

                            // Redirect the user to the welcome page
                            echo "<script>window.location.href='index.php';</script>";
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
<?php include('include/head.php') ?>
<!-- End Head -->

<body>
    <!-- Spinner Start -->
    <?php include('include/spinner.php') ?>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <?php include('include/topbar.php') ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include('include/navbar.php')?>
    <!-- Navbar End -->

    <!-- Login form start -->
    <div class="container register_form">
        <div class="row">
            <div class="register-color-background py-4 text-center">
                <h2 class="register-color">Welcome to Sweet Factory</h2>
                <p>Please sign-in to your account and start the adventure</p>
            </div>
            <div class="col-md-8 offset-md-2 py-2 col-sm-10 offset-sm-1">
                <form class="form-block row g-3 py-5" 
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="col-md-12">
                        <label for="emailbox" class="form-label">Email</label>
                        <input type="email" class="form-control login-register-box" id="emailbox"
                        placeholder="example@mail.com" name="email">
                        <span class="error">* <?php echo $err;?></span>
                    </div>
                    <div class="col-md-12">
                        <label for="passwordbox" class="form-label">Password</label>
                        <input type="password" class="form-control login-register-box" id="passwordbox"
                        placeholder="Enter your login password here" name="password">
                        <span class="error">* <?php echo $err;?></span>
                    </div>
                    <div class="col-12 d-grid gap-2 pt-3">
                        <button type="submit" class="btn btn-outline-light login-register-box form-label">Log in</button>
                    </div>
                    <div class="col-12 text-start mt-4">
                        <div class="terms_and_conditions_div">
                            <p class="form-label terms_and_conditions">By creating an account or logging in, you agree to 
                            our 
                            <a href="" class="text-light register-links">Conditions of Use</a>
                            and
                            <a href="" class="text-light register-links">Privacy Policy.</a></p>
                            <hr class="text-light">
                            <div class="text-center">
                            <p class="form-label terms_and_conditions">Don't have an account? <a href="register.php" class="text-light register-links">Register now.</a></p>
                            </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login form end -->

    <!-- Footer Start -->
    <?php include('include/footer.php') ?>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <?php include('include/copyright.php') ?>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <?php include('include/js.php') ?>
    <!-- End JavaScript Libraries -->

</body>

</html>