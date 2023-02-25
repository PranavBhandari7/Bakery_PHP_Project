<?php
    session_start();
    include("include/config.php");
    $city = $address = $phonenumber = "";
    $city_err = $address_err = $phonenumber_err = "";

    if(isset($_POST["purchase"]))
    {
        function validate($data)
        {
            $data = trim($data);
        
            $data = stripslashes($data);
        
            $data = htmlspecialchars($data);
        
            return $data;
        }

        if(empty($_POST["city"]))
        {
            $city_err = "City is required";
        }
        
        else
        {
            $city = validate($_POST["city"]);
        }

        if(empty($_POST["address"]))
        {
            $address_err = "Address is required";
        }
        
        else
        {
            $address = validate($_POST["address"]);
        }

        if(empty($_POST["phonenumber"]))
        {
            $phonenumber_err = "Phone Number is required";
        }

        if($_POST["phonenumber"] > 10)
        {
            $phonenumber_err = "Phone number can only have 10 digits";
        }
        
        else
        {
            $phonenumber = validate($_POST["phonenumber"]);
        }

        {
            $query = "INSERT INTO orders (fk_product_id, fk_user_id, price, city, address, phone_no, uuid)
            VALUES (?,?,?,?,?,?,?)";

            $email = $_SESSION["email"];                 
            $get_id = "SELECT user_id FROM users where email = '$email'";
            $result = mysqli_query($conn,$get_id);
            if ($result) 
            {
                if ($result->num_rows > 0) 
                {
                    $row = $result->fetch_assoc();
                    $user_id = $row["user_id"];
                }
            }
            
            $stmt = mysqli_prepare($conn, $query);
            if($stmt)
            {
                mysqli_stmt_bind_param($stmt, "iidssis",$product_id, $user_id, $price,
                $user_city, $user_address, $user_phone_no, $uuid);

                $dataInserted = FALSE;
                $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
                $user_city = $city;
                $user_address = $address;
                $user_phone_no = $phonenumber;

                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    $product_id = $values["item_id"];
                    $price = $values["item_price"];

                    mysqli_stmt_execute(($stmt));
                }
                unset($_SESSION["shopping_cart"]);
            } 
            mysqli_stmt_close($stmt);    
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

    <!-- Checkout start -->
    <main style="margin:21rem 0rem">
        <div class="container-fluid">
            <div class="container bg-dark p-5">         
                <?php
                    if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])>0)
                    {
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
                method="post" autocomplete="off" class="form-block">
                    <div class="row">
                        <div class="register-color-background py-3 mb-3 text-center col-md-12">
                            <h2 class="register-color">Checkout Details</h2>
                        </div>

                        <div class="col-md-12">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" style="border-radius: 0px;" 
                            id="city" placeholder="Enter your city name" name="city">
                            <span class="error">* <?php echo $city_err;?></span>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" style="border-radius: 0px;" 
                            id="address" placeholder="Enter you address details here" name="address">
                            <span class="error">* <?php echo $address_err;?></span>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" style="border-radius: 0px;" 
                            id="phoneNumber" placeholder="Enter your phone number here" name="phonenumber">
                            <span class="error">* <?php echo $phonenumber_err;?></span>
                        </div>

                        <div class="col-12 mt-3 text-center">
                            <button type="submit" class="form-label btn btn-primary" name="purchase" 
                            style="border-radius: 0px;">Purchase</button>
                        </div>
                    </div>    
                </form>
                <?php
                    }
                    else
                    {
                        echo "<div class='text-center'><h3 class='text-light'>Your cart is empty</h3></div>";
                    }
                ?>
            </div>
        </div>
    </main>
    <!-- Checkout End -->

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