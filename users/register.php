<?php
    require_once("include/config.php");

    // Declare the variables
    $email = $password = $confirm_password = $username = "";
    $email_err = $password_err = $confirm_password_err = $username_err = "";

    // Check if the request method is post
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST['email']) && isset($_POST['password'])  
            && isset($_POST['confirm_password']) && isset($_POST['username'])) 
        {
          function validate($data)
          {
    
            $data = trim($data);
       
            $data = stripslashes($data);
        
            $data = htmlspecialchars($data);
        
            return $data;
          }
        }

        if(empty($_POST["email"]))
        {
            $email_err = "email cannot be blank";
        }
        // Check if e-mail address is well-formed
        else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            $email_err = "Invalid email format";
        }

        else 
        {   // Else, if there are no errors in the email then
            $sql = "SELECT user_id FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn,$sql);
            if($stmt)
            {
                //param_email is the variable which we will use to bind the statement
                mysqli_stmt_bind_param($stmt,"s",$param_email);

                //  Set the value of the param_email
                $param_email = validate($_POST["email"]);
                //  $param_email = validate(stripslashes(htmlspecialchars($_POST["email"])));

                //  Try to execute this statement
                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        $email_err = "This email already exists";
                    }
                    // If everything is fine then set the $email with the POST value
                    else
                    {
                        $email = validate($_POST["email"]);
                    }
                }
                // If any problem executing the statement then display the error message
                else
                {
                    echo "something went wrong";
                }
            }
            mysqli_stmt_close($stmt);
        }

        // Now Check for password
        if(empty($_POST["password"]))
        {
            $password_err = "Password cannot be blank";
        }

        else if(strlen(validate($_POST["password"])) < 5)
        {
            $password_err = "Password cannot be less than 5 characters";
        } 

        else
            $password = validate($_POST["password"]);

        // Now Check for confirm password field
        if(validate($_POST["confirm_password"])!= validate($_POST["password"])){
            $password_err = "Password does not match";
        }

        // Now Check for username field
        if (empty($_POST["username"])) 
        {
            $username_err = "Username is required";
        }
        
        // Check if name only contains letters and whitespace
        else if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["username"])) 
        {
            $username_err = "Only letters and white spaces allowed";
        }

        else
        {
            $username = validate($_POST["username"]);
        }

        // If there were no errors and the passwords match then go ahead and insert into the database
        if(empty($username_err) && empty($password_err) 
            && empty($confirm_Password_err) && empty($username_err))
        {

            // Create the INSERT statement
            $sql = "INSERT INTO users (username, email, password) VALUES (? , ? , ?)";

            // After the statement is created then use the prepare the statement
            $stmt = mysqli_prepare($conn,$sql);

            if($stmt)
            {
                mysqli_stmt_bind_param($stmt,"sss", 
                $param_username,$param_email,$param_password);

                // Set these parametres
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Try to execute the query
                if(mysqli_stmt_execute(($stmt)))
                {
                    echo "<script>window.location.href='login.php';</script>";
                }
                else
                {
                    echo "Something went wrong... cannot redirect";
                }
            }
            mysqli_stmt_close($stmt);
        }
            mysqli_close($conn);
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

    <!-- Registration form start -->
    <div class="container register_form">
        <div class="row">
            <div class="register-color-background py-4 text-center col-12">
                <h2 class="register-color">Welcome to Sweet Factory</h2>
                <p>Make your app management easy and fun!</p>
            </div>
            <div class="col-md-8 offset-md-2 py-2 col-sm-10 offset-sm-1">
                <form class="form-block row g-3 py-5" 
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="col-md-12">
                        <label for="emailbox" class="form-label">Email</label>
                        <input type="email" class="form-control login-register-box" id="emailbox"
                        placeholder="example@mail.com" name="email">
                        <span class="error">* <?php echo $email_err;?></span>
                    </div>
                    <div class="col-md-12">
                        <label for="passwordbox" class="form-label">Password</label>
                        <input type="password" class="form-control login-register-box" id="passwordbox"
                        placeholder="Enter the password here" name="password">
                        <span class="error">* <?php echo $password_err;?></span>
                    </div>
                    <div class="col-md-12">
                        <label for="confirm_passwordbox" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control login-register-box" id="confirm_passwordbox"
                        placeholder="Confirm your password here" name="confirm_password">
                        <span class="error">* <?php echo $confirm_password_err;?></span>
                    </div>
                    <div class="col-12">
                        <label for="Usernamebox" class="form-label">Username</label>
                        <input type="text" class="form-control login-register-box" id="Usernamebox" 
                        placeholder="Enter your username here" name="username">
                        <span class="error">* <?php echo $username_err;?></span>
                    </div>
                    <div class="col-12 d-grid gap-2 pt-3">
                        <button type="submit" class="form-label btn btn-outline-light login-register-box">Create Account</button>
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
                            <p class="form-label terms_and_conditions">Already have an account? <a href="login.php" class="text-light register-links">Sign in.</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Registration form end -->

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