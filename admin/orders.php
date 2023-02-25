<?php  require_once("includes/sessionstatus.php"); ?>
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
            <h2>Orders</h2>
        </div>
        <table class="table table-bordered text-center">
            <thead class="bg-primary text-light">
                <tr>
                    <!-- <th scope="col">S.No</th> -->
                    <th scope="col">User_ID</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Total Items</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    include("includes/config.php");
                    $query = "SELECT uuid FROM orders GROUP BY uuid";
                    $passQuery = mysqli_query($conn, $query);
                    if ($passQuery->num_rows > 0)
                    {
                        $count = 1;
                        while ($rows = $passQuery->fetch_assoc())
                        {
                            $subquery = "SELECT * from orders where uuid = '". $rows['uuid']  ."'";
                            $passSubQuery = mysqli_query($conn, $subquery);
                            $uuid = mysqli_fetch_all($passSubQuery,MYSQLI_ASSOC);

                            $tPrice = 0; $user_id = 0;
                            $tItems = COUNT($uuid);

                            foreach($uuid as $key => $value) 
                            {
                                $user_id = ($value['fk_user_id']);
                                $tPrice += $value['price'];
                                $tItems = ($value["fk_product_id"]);
                            }
                            echo "<tr>
                                    <td></td>
                                    <td>$user_id</td>
                                    <td>$tPrice</td>
                                    <td>$tItems</td>
                                    <td></td>
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