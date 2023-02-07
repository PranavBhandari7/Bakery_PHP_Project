<?php  
    require_once("includes/sessionstatus.php"); 
    include("includes/config.php");

    $id = $_GET["id"];

   // Declare the variables
   $name = $price = $description = $image = $category = $tempname = "";
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

       if(isset($_POST["name"]))
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
        {
           $price = validate($_POST["price"]);
        }

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
            $image = validate($_POST["old_image"]);
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
    
            if (file_exists($target_file)) 
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
                    unlink($target_dir.'/'.$_POST["old_image"]);
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
            //  Create the INSERT statement
            $sqlcommand = "UPDATE  products SET product_name = '$name', pro_des = '$description', 
            pro_image = '$image', pro_price = '$price', category_id = '$category' WHERE product_id = $id";
            $query = mysqli_query($conn,$sqlcommand);

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

    <!-- Main Content -->
    <main id="main" class="main">
        <?php
        include("includes/config.php");
        $query = "SELECT products.product_name, products.pro_price,
        products.pro_des, products.pro_image, categories.category_name,
        products.category_id FROM products INNER JOIN categories ON 
        products.category_id = categories.category_id WHERE product_id = $id";
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
                $productCategory = $row["category_id"];
                $categoryName = $row["category_name"];
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
                        <span class="error">* <?php echo $name_err;?></span>
                    </div>

                    <div class="col-md-6">
                        <label for="productprice" class="form-label">Product Price:</label>
                        <input type="text" class="form-control order-input form-group" 
                        placeholder="Enter your gmail" name="price" 
                        value="<?php echo $productPrice; ?>" id="productprice">
                        <span class="error">* <?php echo $price_err;?></span>
                    </div>

                    <div class="col-md-6">
                        <label for="productdescription" class="form-label">Product Description:</label>
                        <textarea type="text" class="form-control order-input form-group" id="productdescription"
                        name="description"><?php echo $productDescription;?></textarea>
                    <span class="error">* <?php echo $description_err;?></span>
                    </div>

                    <div class="col-md-6">
                        <label for="category-type" class="form-label">Category</label>
                        <select class="me-2 form-control" name="category">
                                <option value="<?php echo $productCategory;?>"><?php echo $categoryName;?></option>
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

                    <div class="col-md-6">
                        <img src="/backendImages/<?php echo $productImage?>" width="400px" alt="">
                    </div>
                    <div class="col-md-6">
                        <label for="productimage" class="form-label">Product Image:</label>
                        <input type="file" class="form-control order-input form-group" 
                        id="productimage" name="image">
                        
                        <input type="hidden" class="form-control order-input form-group" id="productimage"
                        name="old_image" value="<?php echo $productImage;?>">
                        <span class="error">* <?php echo $image_err;?></span>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success mt-2" name="submit">Apply Changes</button>
                        </div>
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
