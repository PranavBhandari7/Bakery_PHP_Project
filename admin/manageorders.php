<?php  require_once("includes/sessionstatus.php"); ?>
<?php
    $query == "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["orders"]))
        {
            // $query == "users";
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
        <div class="row mb-4">
            <div class="col-md-6 text-md-start text-center">
                <h2>Orders</h2>
            </div>
            <div class="col-md-6 text-md-end text-center">
                <form action="" method="POST">
                    <select class="btn btn-outline-primary me-2" name="orders">
                        <option value="">Select Status</option>
                        <option value="">Preparing</option>
                        <option value="">Delivered</option>
                        <option value="">Cancelled</option>
                        <option value="">Rejected</option>
                    </select>
                    <button class="btn btn-outline-success" type="submit">Search
                    <span><i class="fa-solid fa-magnifying-glass"></i></span></button>
                </form>
            </div>
        </div>
        <table class="table table-bordered text-center">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product_id</th>
                    <th scope="col">User_id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Order_date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("includes/config.php");
                    $query = "SELECT * from orders";
                    $passQuery = mysqli_query($conn, $query);
                    if ($passQuery->num_rows > 0)
                    {
                        while ($rows = $passQuery->fetch_assoc()){
                        echo "<tr>
                                <td>$rows[order_id]</td>
                                <td>$rows[product_id]</td>
                                <td>$rows[user_id]</td>
                                <td>₹$rows[amount]</td>
                                <td>$rows[order_date]</td>
                                <td>
                                    <form action='method='POST'>
                                        <select class='btn btn-outline-primary me-2' name='orders'>
                                            <option value=''>Select Status</option>
                                            <option value=''>Preparing</option>
                                            <option value=''>Delivered</option>
                                            <option value=''>Cancelled</option>
                                            <option value=''>Rejected</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>";
                        }
                    }

                    else 
                    {
                        $conn->error;
                    }
                ?>
            </tbody>
        </table>
    </main>
    <!-- End Main Content -->
    
    <?php include('includes/config.php') ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include('includes/js.php') ?>
    <!-- End Vendor JS Files -->

</body>
</html>