<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include('includes/adminHead.php') ?>
<!-- End Head -->

<body>
    <!-- ======= Header ======= -->
    <?php include('includes/header.php') ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include('includes/sidebar.php') ?> 
    <!-- End Sidebar -->
    
    <main id="main" class="main">
        <h3>Add Products Here</h3>
        <form class="row g-3 mt-4">
            <div class="col-md-6">
                <label for="product-name" class="form-label">Product Name</label>
                <input type="text" class="form-control" 
                id="product-name" placeholder="Write product name here">
            </div>

            <div class="col-4">
                <label for="inputAddress2" class="form-label">Product Price</label>
                <input type="text" class="form-control" 
                id="inputAddress2" placeholder="Write product price here">
            </div>

            <div class="col-md-12">
                <label for="inputPassword4" class="form-label">Product Description</label>
                <textarea type="password" class="form-control" id="inputPassword4"></textarea>
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Add Product Image</label>
                <input type="file" class="form-control" id="inputAddress">
            </div>

            <div class="col-12 text-center">
                <a href="" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-success">Add Product</button>
            </div>
        </form>
    </main>
    <!-- End Main Content -->
    <?php include('includes/config.php') ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include('includes/js.php') ?>
    <!-- End Vendor JS Files -->

</body>

</html>