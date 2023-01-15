<?php
    include("includes/config.php");

    // Declare the variables
    $product_name = $product_price = $product_description = $product_image = "";
    $product_name_err = $product_price_err = $product_description_err = $product_image_err = "";

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

        if(empty($_POST["product_name"]))
        {
            $product_name_err = "Please choose product name";
        }

        else 
        {  
            $product_name = validate($_POST["product_name"]);

            $sql = "SELECT * FROM products WHERE product_name ='$product_name'";

            $query = mysqli_query($conn,$sql);

            if (mysqli_num_rows($query) > 0) 
            {               
                $product_name_err = "Product name already exists";
            }
        }

        if(empty($_POST["product_price"]))
        {
            $product_price_err = "Price field cannot be empty";
        }

        else
            $product_price = validate($_POST["product_price"]);

        if (empty($_POST["product_description"])) 
        {
            $product_description_err = "Product description cannot be empty";
        }

        else
        {
            $product_description = validate($_POST["product_description"]);
        }

        if (empty($_FILES["product_image"]["name"])) 
        {
            $product_image_err = "Please upload the image of the product";
        }

        else
        {
            $product_image = $_FILES["product_image"]["name"];
            $tempname = $_FILES["product_image"]["tmp_name"];
            $target_dir = "/Users/pranavbhandari/Documents/GitHub/Bakery_PHP_Project/admin/assets/img/";
            $target_file = $target_dir . basename($product_image);

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
            if ($_FILES["product_image"]["size"] > 500000) 
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
                    echo "The file " . htmlspecialchars(basename($product_image)) . " has been uploaded.";
                } 
                else 
                {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        if(empty($product_name_err) && empty($product_price_err) 
            && empty($product_description_err) && empty($product_image_err))
        {
            // Create the UPDATE statement
            $sql = "UPDATE  `products` SET `product_name` = $product_name' , `pro_des` = '$product_description', 
            `pro_image` = '$product_image', `pro_price` = '$product_price' WHERE product_id = $id";

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
    }
    $conn->close();
?>