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
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Filters Start -->
    <div class="bg-warning py-3">
        <div class="container">
            <div class="row">
                <div class="col-3 text-start">
                    <h4 class="text-light">Filter:</h4>
                </div>
                <div class="col-3">
                    <label for="categories" class="text-light">Category:</label>
                    <select class="form-label dropdown py-2 px-2 ms-2" id="categories">
                    <option value="">Select</option>
                    <option value="">Pastries</option>
                    <option value="">Cakes</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- Filters End -->

    <!-- Add to cart start -->
    <main class="bg-light" style="margin: 12rem 0;">
        <div class="container" style="padding:7rem 0rem">
            <div class="row g-3">

                <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                    <div class="card">
                        <img src="assets/img/product-1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>Product 1</h6>
                            <p style="display:inline-block">₹5.68</p>
                            <a href="details.php" target="_blank" class="btn btn-outline-warning ms-xl-5 ms-sm-3">Add</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                    <div class="card">
                        <img src="assets/img/product-2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>Product 2</h6>
                            <p style="display:inline-block">₹5.68</p>
                            <a href="details.php" target="_blank" class="btn btn-outline-warning ms-xl-5 ms-sm-3">Add</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                    <div class="card">
                        <img src="assets/img/product-3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>Product 3</h6>
                            <p style="display:inline-block">₹5.68</p>
                            <a href="details.php" target="_blank" class="btn btn-outline-warning ms-xl-5 ms-sm-3">Add</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                    <div class="card">
                        <img src="assets/img/product-1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>Product 4</h6>
                            <p style="display:inline-block">₹5.68</p>
                            <a href="details.php" target="_blank" class="btn btn-outline-warning ms-xl-5 ms-sm-3">Add</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                    <div class="card">
                        <img src="assets/img/product-2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>Product 5</h6>
                            <p style="display:inline-block">₹5.68</p>
                            <a href="details.php" target="_blank" class="btn btn-outline-warning ms-xl-5 ms-sm-3">Add</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                    <div class="card">
                        <img src="assets/img/product-3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>Product 6</h6>
                            <p style="display:inline-block">₹5.68</p>
                            <a href="details.php" target="_blank" class="btn btn-outline-warning ms-xl-5 ms-sm-3">Add</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                    <div class="card">
                        <img src="assets/img/product-1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>Product 7</h6>
                            <p style="display:inline-block">₹5.68</p>
                            <a href="details.php" target="_blank" class="btn btn-outline-warning ms-xl-5 ms-sm-3">Add</a>
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