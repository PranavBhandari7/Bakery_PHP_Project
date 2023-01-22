<?php
    require_once("includes/sessionstatus.php");
    require_once("includes/config.php");

    // Declare the variables
    $name = $price = $description = $image = "";
    $name_err = $price_err = $description_err = $image_err = "";

    // Check if the request method is post
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        function validate($data)
        {

            $data = trim($data);
        
            $data = stripslashes($data);
        
            $data = htmlspecialchars($data);
        
            return $data;
        }

        if(empty($_POST["name"]))
        {
            $name_err = "Please choose product name";
        }

        else 
        {  
            $name = validate($_POST["name"]);

            $sql = "SELECT * FROM products WHERE product_name ='$name'";

            $query = mysqli_query($conn,$sql);

            if (mysqli_num_rows($query) > 0) 
            {               
                $name_err = "Product name already exists";
            }
        }

        if(empty($_POST["price"]))
        {
            $price_err = "Price field cannot be empty";
        }

        else
            $price = validate($_POST["price"]);

        if (empty($_POST["description"])) 
        {
            $description_err = "Product description cannot be empty";
        }

        else
        {
            $description = validate($_POST["description"]);
        }

        if (empty($_FILES["image"]["name"])) 
        {
            $image_err = "Please upload the image of the product";
        }

        else
        {
            $image = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $target_dir = "/Users/pranavbhandari/Documents/GitHub/Bakery_PHP_Project/backendImages/";
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

        if(empty($name_err) && empty($price_err) 
            && empty($description_err) && empty($image_err))
        {
            // Create the INSERT statement
            $sql = "INSERT INTO  `products` (`product_name`, `pro_des`, `pro_image`, `pro_price`) 
            VALUES ('$name' , '$description' , '$image' , '$price')";

            $query = mysqli_query($conn,$sql);

            if($query)
            {
                echo "<script>window.location.href='products.php';</script>";
            }
            else
            {
                echo "Something went wrong... cannot redirect";
            }
        
        }
            mysqli_close($conn);
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
        <h3>Add Categories Here</h3>
        <form class="row g-3 mt-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
        enctype="multipart/form-data" method="post">
            <div class="col-md-12">
                <label for="category-name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name"
                id="category-name" placeholder="Enter category name here">
                <span class="error">* <?php echo $name_err;?></span>
            </div>

            <div class="col-md-12">
                <label for="inputAddress" class="form-label">Add Product Image</label>
                <input type="file" class="form-control" 
                name="image" id="inputAddress">
                <span class="error">* <?php echo $image_err;?></span>
            </div>

            <div class="col-md-12 text-center">
                <a href="categories.php" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-success">Create Category</button>
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