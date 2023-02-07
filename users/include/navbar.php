<nav class="navbar navbar-expand-xl navbar-dark fixed-top py-lg-0 px-xl-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">Sweet Factory.Co</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Services</a>
                <a href="products.php" class="nav-item nav-link">Products</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>

                <div class=" d-md-flex nav-item pt-4 ps-lg-3">
                    <div class="flex-shrink-0 btn-lg-square border border-light rounded-circle position-relative">
                        <a href="mycart.php">
                        <span class="icons ps-2 me-2" data-bs-toggle="tooltip" 
                            data-bs-placement="bottom" title="Add to cart">
                            <i class="fa-solid fa-cart-shopping text-light"></i>
                            <?php
                                if(!empty($_SESSION["shopping_cart"]))
                                {
                                    $items = count($_SESSION["shopping_cart"]);
                                    echo "<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary'>
                                    $items</span>";
                                }
                                else
                                {
                                    echo "<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'>
                                    0</span>";
                                }
                            ?>
                        </span>
                        </a>
                    </div>
                </div>

                <div class="d-md-flex nav-item pt-4 ps-lg-3">
                    <div class="flex-shrink-0 btn-lg-square border border-light rounded-circle">
                        <a href="register.php">
                        <span class="icons ps-2 me-2" data-bs-toggle="tooltip" 
                        data-bs-placement="bottom" title="Login or Sign Up here">
                        <i class="fa fa-regular fa-user text-light"></i>
                        </span>
                        </a>
                    </div>
                    <div class="login-icon ps-2">
                        <small class="text-primary mb-0">
                            <?php
                                if(!isset($_SESSION["loggedin"]))
                                {
                                    echo "Hi Guest!";
                                }

                                else
                                {
                                    // include("include/config.php");
                                    // $query = `SELECT username FROM users WHERE email = '$_SESSION["email"]'`;
                                    // $result = mysqli_query($conn, $query);
                                    echo "Hi" . " " . $_SESSION["email"] . " !";
                                }                              
                            ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </nav>