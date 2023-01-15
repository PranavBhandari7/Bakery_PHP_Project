<?php
    include("includes/config.php");
    if(isset($_POST["submit"]))
    {
        if (isset($_FILES["image"]["name"])) 
        {
            $image = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $target_dir = "/Users/pranavbhandari/Documents/GitHub/Bakery_PHP_Project/admin/assets/img/";
            $target_file = $target_dir . basename($image);

            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($tempname);

            if ($check !== false) 
            {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } 
            else 
            {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) 
            {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            if ($_FILES["image"]["size"] > 500000) 
            {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
            {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                $uploadOk = 0;
            }
        
            if ($uploadOk == 0) 
            {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } 
            else 
            {
                if (move_uploaded_file($tempname, $target_file)) 
                {
                    echo "The file " . htmlspecialchars(basename($image)) . " has been uploaded.";
                } 
                else 
                {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
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
    
    <main id="main" class="main">
        <?php
            include("includes/config.php");
            $id = $_GET["id"];
            $query = "SELECT * FROM products WHERE product_id = $id";
            $passQuery = mysqli_query($conn, $query);
            if ($passQuery) 
            {
                if ($passQuery->num_rows > 0) 
                {
                    $row = $passQuery->fetch_assoc();
                    $productImage = $row["pro_image"];
                }
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 text-center">
                    <label for="productimage" class="form-label">Product Image</label>
                    <br>
                    <img class="w-25" src="assets/img/<?php echo $productImage ?>" alt="" id="productimage">
                </div>

                <div class="col-md-12 mt-3">
                    <input type="file" class="form-control" value="<?php echo $productImage?>"
                    name="image">
                    <!-- <span class="error">* <?php echo $product_image_err;?></span-->
                </div>

                <div class="col-md-12 text-center mt-5">
                    <button type="submit" class="btn btn-outline-success" name="submit">Update</button>
                </div>
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