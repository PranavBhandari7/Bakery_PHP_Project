<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include('include/head.php') ?>
<!-- End Head -->

<body>
    <!-- Spinner Start -->
    <?php include('include/spinner.php') ?>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <?php include('include/topbar.php') ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include('include/navbar.php')?>
    <!-- Navbar End -->

    <!-- Add to cart start -->
    <main style="margin:10rem">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <img src="assets/img/product-1.jpg" class="img-fluid" alt="">
                    <div class="mt-3 text-center">
                        <label for="qauntity">Qauntity</label>
                        <select class="form-label quantity py-2 px-2 ms-2" id="quantity">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                            <option value="">6</option>
                            <option value="">7</option>
                            <option value="">8</option>
                            <option value="">9</option>
                            <option value="">10</option>
                        </select>                       
                    </div>
                    <div class="mt-3 text-center">
                        <button class="btn btn-outline-success">Add to cart</button>
                        <button class="btn btn-outline-warning ms-2">Add to wishlist</button>
                        <button class="btn btn-outline-primary ms-2">Place Order</button>
                    </div>
                </div>
                <div class="col-7">
                    <div>
                        <h5 class="product-heading">Product 1</h5>
                        <label for="star-rating">Ratings</label>
                        <button disabled="disabled" class="btn btn-success ratings" 
                        id="star-rating">4.8</button>
                        <p class="amount">₹5.68</p>
                        <p style="font-size: 13px; margin-top:-1.2rem">Inclusive of all taxes</p>
                    </div>
                    <div>
                        <h4>Description</h4>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque sed ducimus odit similique asperiores rem quia in 
                        voluptatem officiis pariatur natus nisi consectetur suscipit, enim nostrum ipsam deleniti fugit ad.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Add to cart end -->

    <!-- Footer Start -->
        <?php include('include/footer.php') ?>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <?php include('include/copyright.php') ?>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <?php include('include/js.php') ?>
    <!-- End JavaScript Libraries -->

</body>

</html>