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
            <h2>Categories</h2>
        </div>
        <table class="table table-bordered text-center">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">Category_ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Other Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("includes/config.php");
                    $query = "SELECT * from categories";
                    $passQuery = mysqli_query($conn, $query);
                    if ($passQuery->num_rows > 0)
                    {
                        while ($rows = $passQuery->fetch_assoc())
                        {
                            echo "<tr>
                                    <td>$rows[category_id]</td>
                                    <td>$rows[category_name]</td>
                                    <td class='text-center'><img src='/categoryImages/$rows[category_image]' width='70px'></td>
                                    <td>
                                        <a href='showcategories.php?id=$rows[category_id]' 
                                        class='btn btn-outline-primary me-2'>Show</a>

                                        <a href='editcategories.php?id=$rows[category_id]' target='_blank'>
                                        <button type='submit' class='btn btn-outline-success me-2' name='edit'>
                                        Edit</button></a>

                                        <a href='deletecategories.php?id=$rows[category_id]' onclick='return checkDelete()'>
                                        <button type='submit' class='btn btn-outline-danger' name='delete'>
                                        Delete</button></a>
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
<script>
    function checkDelete() 
    {
      return confirm('Are you sure you want to delete this record?');
    }
</script>
</html>