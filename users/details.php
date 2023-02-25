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
            <?php
                    include("include/config.php");
                    $id = $_GET["id"];
                    $query = "SELECT * FROM products WHERE product_id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($result) 
                    {
                        if ($result->num_rows > 0) 
                        {
                            $row = $result->fetch_assoc();
                            $productName = $row["product_name"];
                            $productPrice = $row["pro_price"];
                            $productDescription = $row["pro_des"];
                            $productImage = $row["pro_image"];
                        }
                    }
            ?>
            <form action="mycart.php?id=<?php echo $id ?>" method="post">
                    <div class="row">
                        <div class="col-lg-6 text-lg-start text-center">
                            <img src="/backendImages/<?php echo $productImage ?>" class="productImage" alt="">
                        </div>

                        <div class="col-lg-6 text-lg-start text-center">
                            <div> 
                                <h5 class="product-heading"><?php echo $productName ?></h5>
                                <p class="amount">₹<?php echo $productPrice ?>/<span style="font-size:2rem">Kg</span></p>
                                <p class="text-dark" style="font-size: 14px; margin-top:-1.2rem">Inclusive of all taxes</p>
                            </div>
                            <div>
                                <h4>Description</h4>
                                <p class="text-dark"><?php echo $productDescription ?></p>
                            </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Weight</h4>
                                        <div class="mt-3">
                                            <select class="quantity form-control" id="quantity" name="product_weight">
                                                <option value="1">1 Kg</option>
                                                <option value="2">2 Kg</option>
                                                <option value="3">3 Kg</option>
                                                <option value="4">4 Kg</option>
                                                <option value="5">5 Kg</option>
                                                <option value="6">6 Kg</option>
                                                <option value="7">7 Kg</option>
                                                <option value="8">8 Kg</option>
                                                <option value="9">9 Kg</option>
                                                <option value="10">10 Kg</option>
                                            </select>                      
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Quantity</h4>
                                        <div class="mt-3">
                                            <input type="number" min="1" max="10" name="product_quantity" class="form-control" value="1">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="product_image" value="<?php echo $productImage; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $productPrice; ?>">

                                <div class="mt-3 text-center">
                                    <button class="btn btn-outline-success" type="submit"
                                    name="mycart">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
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