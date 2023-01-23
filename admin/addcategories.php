<?php
    require_once("includes/sessionstatus.php"); 
    require_once("includes/config.php");

    // Declare the variables
    $category_name = $category_image = "";
    $category_name_err = $category_image_err = "";

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

        if(empty($_POST["category_name"]))
        {
            $category_name_err = "Please choose category name";
        }

        else 
        {  
            $category_name = validate($_POST["category_name"]);

            $sql = "SELECT * FROM categories WHERE category_name ='$category_name'";

            $query = mysqli_query($conn,$sql);

            if (mysqli_num_rows($query) > 0) 
            {               
                $category_name_err = "Category name already exists";
            }
        }

        if (empty($_FILES["category_image"]["name"])) 
        {
            $category_image_err = "Please upload the image of the product";
        }

        else
        {
            $category_image = $_FILES["category_image"]["name"];
            $tempname = $_FILES["category_image"]["tmp_name"];
            $target_dir = "/Users/pranavbhandari/Documents/GitHub/Bakery_PHP_Project/categoryImages/";
            $target_file = $target_dir . basename($category_image);

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($tempname);

            if ($check == false) 
            {
                $category_image_err =  "File is not an image.";
            } 

            else if (file_exists($target_file)) 
            {
                $category_image_err =  "Sorry, file already exists. Please select another file";
            }
            else if ($_FILES["category_image"]["size"] > 5000000) 
            {
                $category_image_err =  "Sorry, your file is too large.";
            }
            else if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
            {
                $category_image_err =  "Sorry, only JPG, JPEG, PNG files are allowed.";
            }
        
            else
            {
                if (move_uploaded_file($tempname, $target_file)) 
                {
                    $category_image_err = "";
                } 
                else 
                {
                    $category_image_err =  "Sorry, there was an error uploading your file.";
                }
            }
        }

        if(empty($category_name_err) && empty($category_image_err))
        {
            // Create the INSERT statement
            $sql = "INSERT INTO  `categories` (`category_name`, `category_image`) 
            VALUES ('$category_name' , '$category_image')";

            $query = mysqli_query($conn,$sql);

            if($query)
            {
                echo "<script>window.location.href='categories.php';</script>";
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
            <div class="col-md-6">
                <label for="category-name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="category_name"
                id="category-name" placeholder="Enter category name here">
                <span class="error">* <?php echo $category_name_err;?></span>
            </div>

            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Add Category Image</label>
                <input type="file" class="form-control" 
                name="category_image" id="inputAddress">
                <span class="error">* <?php echo $category_image_err;?></span>
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