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
            <h2>Admin data</h2>
        </div>
        <table class="table table-bordered">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("includes/config.php");
                    $query = "SELECT * from admin";
                    $passQuery = mysqli_query($conn, $query);
                    if ($passQuery->num_rows > 0){
                        while ($rows = $passQuery->fetch_assoc()){
                        echo "<tr>
                                <td>$rows[admin_id]</td>
                                <td>$rows[email]</td>
                                <td>$rows[username]</td>
                            </tr>";
                        }
                    }

                    else {
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