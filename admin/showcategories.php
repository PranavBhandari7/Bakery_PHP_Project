<?php  require_once("includes/sessionstatus.php"); ?>
<?php
    include("includes/config.php");
    $id = $_GET["id"];
    $query = "SELECT category_name, pro_image, product_name, pro_price, pro_des FROM products 
    INNER JOIN categories ON products.category_id = categories.category_id  
    WHERE categories.category_id = $id";
    $passQuery = mysqli_query($conn, $query);
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
                <div class="col-md-8 text-center">
                    <h1>Category Data</h1>
                </div>
                <div class="col-md-2">
                    <a href="categories.php" class="btn btn-success">Back</a>
                </div>
            </div>
        </div>
        <div class='container' style='padding:7rem 0rem'>
            <div class='row'>
                <?php
                    if ($passQuery) 
                    {
                        if ($passQuery->num_rows > 0) 
                        {
                            while($row = $passQuery->fetch_assoc())
                            {
                                echo " <div class='col-md-3 col-sm-4 p-0'>
                                <div class='card' style=width:11.8rem>
                                    <img src='/backendImages/$row[pro_image]' 
                                    class='card-img-top img-fluid' style='height:130px' alt='...'>
                                    <div class='card-body mt-3'>
                                        <span style=font-size:1.3rem> $row[product_name] - </span>
                                        <span style=font-size:1.0rem>₹$row[pro_price]</span>
                                        <p class='mt-3'>$row[pro_des]</p>
                                    </div>
                                </div>
                            </div>";
                            }
                        }
                    }
                ?>
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