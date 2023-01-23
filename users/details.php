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
            <div class="row">
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
                <div class="col-6">
                    <img src="/backendImages/<?php echo $productImage ?>" class="productImage" alt="">
                </div>
                <div class="col-6">
                    <div>
                        <h5 class="product-heading"><?php echo $productName ?></h5>
                        <label for="star-rating">Ratings</label>
                        <button disabled="disabled" class="btn btn-success ratings" 
                        id="star-rating">4.8</button>
                        <p class="amount">₹<?php echo $productPrice ?></p>
                        <p style="font-size: 13px; margin-top:-1.2rem">Inclusive of all taxes</p>
                    </div>
                    <div>
                        <h4>Description</h4>
                        <p><?php echo $productDescription ?></p>
                    </div>
                    <div>
                        <div class="mt-3">
                            <select class="quantity" id="quantity">
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                                <option value="">7</option>
                                <option value="">8</option>
                                <option value="">9</option>
                                <option value="">10</option>
                            </select>                       
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-outline-success">Add to cart</button>
                            <button class="btn btn-outline-warning ms-2">Add to wishlist</button>
                            <button class="btn btn-outline-primary ms-2">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
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