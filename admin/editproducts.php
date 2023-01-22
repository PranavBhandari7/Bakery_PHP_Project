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
                $productName = $row["product_name"];
                $productPrice = $row["pro_price"];
                $productDescription = $row["pro_des"];
                $productImage = $row["pro_image"];
            }
        }
        ?>
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
        <div class="container">
            <form action="" method="post" class="mt-5" enctype="multipart/form-data">
                <div class="row g-3">

                    <div class="col-12">
                        <label for="productid" class="form-label">Product ID:</label>
                        <input type="text" class="form-control order-input form-group" readonly
                        value="<?php echo $id; ?>" id="productid">
                    </div>

                    <div class="col-md-6">
                        <label for="productid" class="form-label">Product Name:</label>
                        <input type="text" class="form-control order-input form-group"
                        value="<?php echo $productName; ?>" id="productid" name="name">
                        <!-- <span class="error">* <?php echo $product_name_err;?></span> -->
                    </div>

                    <div class="col-md-6">
                        <label for="productprice" class="form-label">Product Price:</label>
                        <input type="text" class="form-control order-input form-group" 
                        placeholder="Enter your gmail" name="price" 
                        value="<?php echo $productPrice; ?>" id="productprice">
                        <!-- <span class="error">* <?php echo $product_price_err;?></span> -->
                    </div>

                    <div class="col-md-12">
                        <label for="productdescription" class="form-label">Product Description:</label>
                        <textarea type="text" class="form-control order-input form-group" id="productdescription"
                        name="description"><?php echo $productDescription;?></textarea>
                    <!-- <span class="error">* <?php echo $product_description_err;?></span> -->
                    </div>

                    <div class="col-md-12">
                        <label for="productimage" class="form-label">Product Image:</label>
                        <input type="file" class="form-control order-input form-group" 
                        id="productimage" name="image">
                        <input type="hidden" class="form-control order-input form-group" id="productimage"
                        name="old_image" value="<?php echo $productimage;?>">
                        <!-- <span class="error">* <?php echo $product_image_err;?></span> -->
                    </div>

                    <!-- <div class="col-md-12">
                        <img src="/backendImages/<?php echo $productImage ?>" width="120" height="120">                      
                        <a href="editimage.php?id=<?php echo $row['product_id'];?>" target='_blank'>
                        Change Image</a>
                    </div> -->

                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-outline-success" name="submit">Apply Changes</button>
                    </div>
                </div>  
            </form>
        </div>
    </main>
    <!-- End Main Content -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include('includes/js.php') ?>
    <!-- End Vendor JS Files -->

</body>
</html>
<?php
    include("includes/config.php");

    // Declare the variables
    $product_name = $product_price = $product_description = $product_image = "";
    $product_name_err = $product_price_err = $product_description_err = $product_image_err = "";

    // Check if the request method is post
    if(isset($_POST["submit"]) == "POST")
    {

        function validate($data)
        {

            $data = trim($data);
        
            $data = stripslashes($data);
        
            $data = htmlspecialchars($data);
        
            return $data;
        }

        if(empty($_POST["product_name"]))
        {
            $product_name_err = "Please choose product name";
        }

        else if(isset($_POST["product_name"]))
        {  
            $product_name = validate($_POST["product_name"]);
        }

        if(empty($_POST["product_price"]))
        {
            $product_price_err = "Price field cannot be empty";
        }

        else if(isset($_POST["product_price"]))
        {
            $product_price = validate($_POST["product_price"]);
        }

        if (empty($_POST["product_description"])) 
        {
            $product_description_err = "Product description cannot be empty";
        }

        if(isset($_POST["product_description"]))
        {
            $product_price = validate($_POST["product_description"]);
        }

        $newImage = $_FILES["image"]["name"];
        // $old_image = $_POST["image_old"];
        $tempname = $_FILES["image"]["tmp_name"];

        // if(empty($_FILES["image"]["name"]))
        // {
        //     $product_image = $old_image;
        // }

        if (isset($_FILES["image"]["name"])) 
        {
            $product_image = $newImage;
            $product_imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($tempname);
            $target_dir = "/Users/pranavbhandari/Documents/GitHub/Bakery_PHP_Project/backendImages/";
            $target_file = $target_dir . basename($product_image);

            if ($check !== false) 
            {
                // "File is an image - " . $check["mime"] . ".";
                $product_image_err = "";
            } 

            else 
            {
                $product_image_err =  "File is not an image.";
            }

            if (file_exists($target_file)) 
            {
                $product_image_err =  "Sorry, file already exists.";
            }

            if ($_FILES["image"]["size"] > 500000) 
            {
                $product_image_err =  "Sorry, your file is too large.";
            }

            if ($product_imageFileType != "jpg" && $product_imageFileType != "png" && $product_imageFileType != "jpeg") 
            {
                $product_image_err =  "Sorry, only JPG, JPEG, PNG files are allowed.";
            }

            else
            {
                if (move_uploaded_file($tempname, $target_file)) 
                {
                    echo  "The file " . htmlspecialchars(basename($product_image)) . " has been uploaded.";
                    $product_image_err = "";
                }   
            }

            if(empty($product_name_err) && empty($product_price_err) 
            && empty($product_description_err) && empty($product_image_err))
            {
                $sqlQuery = "UPDATE products SET product_name='$product_name', 
                pro_des = '$product_description', pro_image = '$product_image', 
                pro_price = '$product_price' where `product_id`=$id";

                $result = mysqli_query($conn, $sqlQuery);
                echo "<script>location.href='products.php'</script>";
                if (!$result) 
                {
                    echo $conn->error;
                }   
            }
        }   
    }
    $conn->close();
?>
