<?php
    require_once("includes/sessionstatus.php");
    include("includes/config.php");
    $id = $_GET["id"];
    $query = "SELECT products.product_id, products.product_name, products.pro_price, products.pro_des,
    products.pro_image, categories.category_name, products.status FROM products 
    INNER JOIN categories ON categories.category_id = products.category_id WHERE product_id = $id";
    $passQuery = mysqli_query($conn, $query);
    if ($passQuery) 
    {
        if ($passQuery->num_rows > 0) 
        {
            $row = $passQuery->fetch_assoc();
            $productId= $row["product_id"];
            $productName = $row["product_name"];
            $productPrice = $row["pro_price"];
            $productDescription = $row["pro_des"];
            $productImage = $row["pro_image"];
            $status = $row["status"];
            $categoryName = $row["category_name"];
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
        <div class="container">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6 text-md-start text-center">
                        <h2>Products data</h2>
                    </div>
                    <div class="col-md-6 text-md-end text-center">
                        <a href="products.php" class="btn btn-success">Back</a>
                    </div>
                </div>
            </div>
            <div class="text-sm-start text-center">
                <p class="mt-2"><strong class="me-2">Product ID:</strong><?php echo $productId?></p>
                <p class="mt-2"><strong class="me-2">Product Name:</strong><?php echo $productName?></p>
                <p class="mt-2"><strong class="me-2">Product Price:</strong>₹<?php echo $productPrice?></p>
                <p class="mt-2"><strong class="me-2">Product Description:</strong><?php echo $productDescription?></p>
                <p class="mt-2"><strong class="me-2">Product Image:</strong><img height='100px' src="/backendImages/<?php echo $productImage?>" alt=""></p>
                <p class="mt-2"><strong class="me-2">Category Name:</strong><?php echo $categoryName?></p>
                <p class="mt-2"><strong class="me-2">Status:</strong><?php echo $status?></p>
            </div>
        </div>
    </main>
    <!-- End Main Content -->
    
    <?php include('includes/config.php') ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include('includes/js.php') ?>
    <!-- End Vendor JS Files -->

</body>
</html>