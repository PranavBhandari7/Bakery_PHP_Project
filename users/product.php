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


    <!-- Product Start -->
    <div class="container-xxl bg-light my-6 py-6 pt-0" style="margin: 12rem 0;">
        <div class="container pt-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">// Bakery Products</p>
                <h1 class="display-6 mb-4">Explore The Categories Of Our Bakery Products</h1>
            </div>
            <div class="row g-4">
                <?php
                    include("include/config.php");
                    $query = "SELECT * from categories";
                    $result = mysqli_query($conn, $query);
                    if ($result->num_rows > 0)
                    {
                        while ($rows = $result->fetch_assoc())
                        {
                            echo "<div class='col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.1s'>
                                    <div class='product-item d-flex flex-column bg-white rounded overflow-hidden h-100'>
                                        <div class='text-center p-4'>
                                            <h3 class='mb-3'>$rows[category_name]</h3>
                                            <span>Hover on the image to explore our categories</span>
                                        </div>
                                        <div class='position-relative mt-auto'>
                                            <img class='' src='/categoryImages/$rows[category_image]' height='350px' alt=''>
                                            <div class='product-overlay'>
                                                <a class='btn btn-lg-square btn-outline-light rounded-circle' href='categories.php?id=$rows[category_id]'>
                                                <i class='fa fa-eye text-primary'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                    }                    
                ?>
            </div>
        </div>
    </div>
    <!-- Product End -->


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