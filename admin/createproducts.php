<?php
    require_once("includes/sessionstatus.php"); 
    require_once("includes/config.php");

    // Declare the variables
    $name = $price = $description = $image = $category = "";
    $name_err = $price_err = $description_err = $image_err = $category_err = "";

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

        if (empty($_POST["category"])) 
        {
            $category_err = "Product category cannot be empty";
        }

        else
        {
            $category = validate($_POST["category"]);
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

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($tempname);

            if ($check == false) 
            {
                $image_err =  "File is not an image.";
            } 

            else if (file_exists($target_file)) 
            {
                $image_err =  "Sorry, file already exists. Please select another file";
            }
            else if ($_FILES["image"]["size"] > 5000000) 
            {
                $image_err =  "Sorry, your file is too large.";
            }
            else if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
            {
                $image_err =  "Sorry, only JPG, JPEG, PNG files are allowed.";
            }
        
            else
            {
                if (move_uploaded_file($tempname, $target_file)) 
                {
                    $image_err = "";
                } 
                else 
                {
                    $image_err =  "Sorry, there was an error uploading your file.";
                }
            }
        }

        if(empty($name_err) && empty($price_err) 
            && empty($description_err) && empty($image_err) && empty($category_err))
        {
            // Create the INSERT statement
            $sql = "INSERT INTO  `products` (`product_name`, `pro_des`, `pro_image`, `pro_price`, `category_id`) 
            VALUES ('$name' , '$description' , '$image' , '$price', '$category')";

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
        <h3>Add Products Here</h3>
        <form class="row g-3 mt-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
        enctype="multipart/form-data" method="post">
            <div class="col-md-6">
                <label for="product-name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name"
                id="product-name" placeholder="Write product name here">
                <span class="error">* <?php echo $name_err;?></span>
            </div>

            <div class="col-md-6">
                <label for="product-price" class="form-label">Product Price</label>
                <input type="text" class="form-control" name="price"
                id="product-price" placeholder="Write product price here">
                <span class="error">* <?php echo $price_err;?></span>
            </div>

            <div class="col-md-6">
                <label for="product-description" class="form-label">Product Description</label>
                <textarea class="form-control" 
                id="product-description" name="description"></textarea>
                <span class="error">* <?php echo $description_err;?></span>
            </div>

            <div class="col-md-6">
                <label for="category-type" class="form-label">Category</label>
                <select class="me-2 form-control" name="category">
                        <option value="">Select Category</option>
                        <?php
                            $query = "SELECT * from categories";
                            $passQuery = mysqli_query($conn, $query);
                            if ($passQuery->num_rows > 0)
                            {
                                while ($rows = $passQuery->fetch_assoc())
                                {
                                    echo" <option value='$rows[category_id]'>$rows[category_name]</option>";
                                }
                            }
                        ?>
                </select>
                <span class="error">* <?php echo $category_err;?></span>
            </div>

            <div class="col-md-12">
                <label for="product-image" class="form-label">Add Product Image</label>
                <input type="file" class="form-control" 
                name="image" id="product-image">
                <span class="error">* <?php echo $image_err;?></span>
            </div>

            <div class="col-md-12 text-center">
                <a href="products.php" class="btn btn-warning">Back</a>
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