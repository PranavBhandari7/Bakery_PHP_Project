<?php
    session_start();
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

    <!-- Add to cart start -->
    <main style="margin:21rem 0rem">
        <div class="container">
            <div class="text-center">
                <hr>
                <h1 class="py-2">Thank You!</h1>
                <hr>
                <div>
                    <h3>Your order was placed successfully</h3>
                </div>
                <?php
                    include("include/config.php");
                    $query = "SELECT "
                ?>
            </div>
            <div class="mt-5 pt-5">
                <h2>Order Details</h2>
            </div>
            <table class="table text-center">
                        <tr>
                            <th scope="col">Item No.</th>
                            <th scope="col">Item Image</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
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

                            <td><?php echo $values['item_weight']?></td>

                            <td><?php echo $values['item_quantity']?></td>

                            <td>₹ <?php echo $values["item_price"];?>
                                  <input type="hidden" value="<?php echo $values['item_price'];?>" class="iprice">
                            </td>
                        
                            <td class="itotal"></td>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td><h3>Total</h3></td>
                            <td id = "gtotal" class="pt-3"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php
                        }
                        ?>                           
                    </table>      
        </div>
    </main>
    <!-- Add to cart end -->

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