<?php
        session_start();
        if(!isset($_SESSION["email"]))
        {
                echo "<script>window.location.href='login.php';</script>";
                exit;
        }
        if(isset($_POST["mycart"]))
        {   
            if(isset($_SESSION["shopping_cart"]))
            {
                $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");

                if(!in_array($_GET["id"], $item_array_id))
                {
                    $count = count($_SESSION["shopping_cart"]);

                    $item_array = 
                            array(
                                'item_id'	    =>	$_GET["id"],
                                'item_name'	    =>	$_POST["product_name"],
                                'item_price'	=>	$_POST["product_price"],
                                'mod_price'     =>  $_POST["product_price"],
                                'item_weight'	=>	$_POST["product_weight"],
                                'item_image'    =>  $_POST["product_image"],
                                'item_quantity' =>  $_POST["product_quantity"]
                            );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                }
                
                else
                {
                    echo '<script>alert("Item Already Added in your cart")</script>';
                }
            }

            else
            {
                $count = 0;

                $item_array = 
                        array(
                            'item_id'	    =>	$_GET["id"],
                            'item_name'	    =>	$_POST["product_name"],
                            'item_price'	=>	$_POST["product_price"],
                            'mod_price'     =>  $_POST["product_price"],
                            'item_weight'	=>	$_POST["product_weight"],
                            'item_image'    =>  $_POST["product_image"],
                            'item_quantity' =>  $_POST["product_quantity"]
                        );
                $_SESSION["shopping_cart"][$count] = $item_array;
            }
        }
        

        if(isset($_POST["removeitem"]))
        {
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if($values["item_id"] == $_GET["id"])
                {
                    unset($_SESSION["shopping_cart"][$keys]);
                    $_SESSION["shopping_cart"] = array_values($_SESSION["shopping_cart"]);
                    echo '<script>alert("Item Removed")</script>';
                    echo '<script>window.location="mycart.php"</script>';
                }
            }
        }

        if(isset($_POST["modweight"]))
        {
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if($values["item_id"] == $_GET["id"])
                {
                    $_SESSION["shopping_cart"][$keys]["item_weight"] = $_POST["modweight"];
                }
            }
        }

        if(isset($_POST["modquantity"]))
        {
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if($values["item_id"] == $_GET["id"])
                {
                    $_SESSION["shopping_cart"][$keys]["item_quantity"] = $_POST["modquantity"];
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

    <!-- Order Details -->
    <main style="margin:21rem 0rem">
            <div class="container">
                <h3>Cart Items</h3>
                <div class="table-responsive">
                    <table class="table text-center">
                        <tr>
                            <th scope="col">Item No.</th>
                            <th scope="col">Item Image</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                        <?php
                        if(!empty($_SESSION["shopping_cart"]))
                        {
                            $total = 0;
                            foreach($_SESSION["shopping_cart"] as $keys => $values)
                            {
                        ?>
                        <tr>
                            <td><?php echo $keys + 1?></td>

                            <td><img src="/backendImages/<?php echo $values["item_image"] ?>" class="itemImage" alt=""></td>
                            
                            <td><?php echo $values["item_name"];?></td>

                            <td>
                                <form action="mycart.php?id=<?php echo $values["item_id"];?>" method="post">
                                
                                    <input type="number" value="<?php echo $values['item_weight'];?>" min="1" max="10"
                                    class="text-center border-success form-control iweight mx-auto" 
                                    onchange="this.form.submit()" name="modweight">
                                </form>
                            </td>

                            <td>
                                <form action="mycart.php?id=<?php echo $values["item_id"];?>" method="post">
                                    <input type="hidden" class="itotal" name="modprice">
                                    <input type="number" value="<?php echo $values['item_quantity']?>" min="1" max="10" 
                                    class="text-center mx-auto border-success form-control iquantity" 
                                    onchange="this.form.submit()" name="modquantity">
                                </form>
                            </td>

                            <td>₹ <?php echo $values["item_price"];?>
                                  <input type="hidden" value="<?php echo $values['item_price'];?>" class="iprice">
                            </td>
                        
                            <td class="itotal"></td>

                            <td>
                                <form action="mycart.php?id=<?php echo $values["item_id"];?>" method="post">
                                    <button name="removeitem" type="submit" class="btn btn-danger">Remove</button>
                                </form>
                        </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="6" class="pt-2" align="right"><h3>Cart Total</h3></td>
                            <td id = "gtotal" class="pt-3"></td>
                            <td>
                                <a href="checkout.php" target="_blank">
                                    <button class="btn btn-success">Checkout</button>
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>                           
                    </table>
                </div>
            </div>
    </main>
    <!-- Order Details end -->

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
<script>
    let number = 1;
    let iweight = document.getElementsByClassName("iweight");
    let iquantity = document.getElementsByClassName("iquantity");
    let iprice = document.getElementsByClassName("iprice");
    let itotal = document.getElementsByClassName("itotal");
    let gtotal = document.getElementById("gtotal");

    function subtotal()
    {
        let gt = 0;
        for(let i=0; i<iprice.length; i++)
        {
            itotal[i].innerText =  (iprice[i].value) * (iquantity[i].value) * (iweight[i].value);
            gt = gt + (iprice[i].value) * (iquantity[i].value) * (iweight[i].value)
        }
        gtotal.innerText =  gt;
    }

    subtotal();
</script>

</html>