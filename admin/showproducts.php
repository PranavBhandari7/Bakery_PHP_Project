<?php
    require_once("includes/sessionstatus.php");
    include("includes/config.php");
    $id = $_GET["id"];
    $query = "SELECT * FROM products WHERE product_id = $id";
    $passQuery = mysqli_query($conn, $query);
    if ($passQuery) 
    {
        if ($passQuery->num_rows > 0) 
        {
            $row = $passQuery->fetch_assoc();
            $productName = $row["product_name"];
            $productPrice = $row["pro_price"];
            $productDescription = $row["pro_des"];
            $productImage = $row["pro_image"];
        }
    }

?>

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

    <!-- Main Content -->
    <main id="main" class="main">
        <div class="text-center mb-4">
            <div class="row">
                <div class="col-md-6 text-center">
                    <h2>Products data</h2>
                </div>
                <div class="col-md-6">
                    <a href="products.php" class="btn btn-success">Back</a>
                </div>
            </div>
        </div>
        <ul>
            <li><strong class="me-2">Product Name:</strong><?php echo $productName?></li>
            <li class="mt-2"><strong class="me-2">Product Price::</strong><?php echo $productPrice?></li>
            <li class="mt-2"><strong class="me-2">Product Description:</strong><?php echo $productDescription?></li>
            <li class="mt-2"><strong class="me-2">Product Image:</strong><img height='100px' src="assets/img/<?php echo $productImage?>" alt=""></li>
        </ul>
    </main>
    <!-- End Main Content -->
    
    <?php include('includes/config.php') ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include('includes/js.php') ?>
    <!-- End Vendor JS Files -->

</body>
</html>