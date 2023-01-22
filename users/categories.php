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


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Products</h1>
        </div>
    </div>
    <!-- Page Header End -->
    
    <!-- Add to cart start -->
    <main class="bg-light" style="margin: 12rem 0;">
        <div class='container' style='padding:7rem 0rem'>
                <div class='row g-3'>
                <?php
                    include("include/config.php");
                    $id = $_GET["id"];
                    $query = "SELECT pro_image, product_name, pro_price FROM products 
                    INNER JOIN categories ON products.category_id = categories.category_id 
                    WHERE categories.category_id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($result->num_rows > 0)
                    {
                        while ($rows = $result->fetch_assoc())
                        {
                            echo "<div class='col-lg-2 col-md-3 col-sm-4 p-0'>
                                        <div class='card'>
                                            <img src='/backendImages/$rows[pro_image]' 
                                            class='card-img-top img-fluid' style='height:130px' alt='...'>
                                            <div class='card-body text-center'>
                                                <h5>$rows[product_name]</h5>
                                                <p class='mt-4' style='display:inline-block'>₹$rows[pro_price]</p>
                                                <a href='details.php' target='_blank' class='btn btn-outline-warning ms-xl-5 ms-sm-3'>Add</a>
                                            </div>
                                        </div>
                                    </div>";
                        }
                    }

                    else 
                    {
                        $conn->error;
                    }
                ?>
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