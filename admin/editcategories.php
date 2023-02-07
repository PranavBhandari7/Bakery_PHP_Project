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
           $name_err = "Please choose category name";
        }

       if(isset($_POST["name"]))
        {  
           $name = validate($_POST["name"]);

           $sql = "SELECT * FROM categories WHERE category_name ='$name'";

           $query = mysqli_query($conn,$sql);

           if (mysqli_num_rows($query) > 0) 
            {               
               $name_err = "Category name already exists";
            }
        }

        if (empty($_FILES["image"]["name"])) 
        {
            $image = validate($_POST["old_image"]);
        }

        else
        {
            $image = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $target_dir = "/Users/pranavbhandari/Documents/GitHub/Bakery_PHP_Project/categoryImages/";
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
            $sqlcommand = "UPDATE  categories SET category_name = '$name', 
            category_image = '$image' WHERE category_id = $id";
            $query = mysqli_query($conn,$sqlcommand);

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

    <!-- Main Content -->
    <main id="main" class="main">
        <?php
        include("includes/config.php");
        $query = "SELECT * FROM categories WHERE category_id = $id";
        $passQuery = mysqli_query($conn, $query);
        if ($passQuery) 
        {
            if ($passQuery->num_rows > 0) 
            {
                $row = $passQuery->fetch_assoc();
                $categoryName = $row["category_name"];
                $categoryImage = $row["category_image"];
            }
        }
        ?>
        <div class="text-center mb-4">
            <div class="row">
                <div class="col-md-6 text-center">
                    <h2>Categories data</h2>
                </div>
                <div class="col-md-6">
                    <a href="categories.php" class="btn btn-success">Back</a>
                </div>
            </div>
        </div>
        <div class="container">
            <form action="" method="post" class="mt-5" enctype="multipart/form-data">
                <div class="row g-3">

                    <div class="col-12">
                        <label for="categoryid" class="form-label">Category ID:</label>
                        <input type="text" class="form-control order-input form-group" readonly
                        value="<?php echo $id; ?>" id="categoryid">
                    </div>

                    <div class="col-md-12">
                        <label for="categoryname" class="form-label">Category Name:</label>
                        <input type="text" class="form-control order-input form-group"
                        value="<?php echo $categoryName; ?>" id="categoryname" name="name">
                        <span class="error">* <?php echo $name_err;?></span>
                    </div>

                    <div class="col-md-6">
                        <img src="/categoryImages/<?php echo $categoryImage?>" width="400px" alt="">
                    </div>
                    <div class="col-md-6">
                        <label for="productimage" class="form-label">Category Image:</label>
                        <input type="file" class="form-control order-input form-group" 
                        id="productimage" name="image">
                        
                        <input type="hidden" class="form-control order-input form-group" id="productimage"
                        name="old_image" value="<?php echo $categoryImage;?>">
                        <span class="error">* <?php echo $image_err;?></span>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success mt-2" 
                            name="submit">Apply Changes</button>
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