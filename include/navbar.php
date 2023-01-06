  <?php
    session_start(); 
  ?>
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
                <a href="product.php" class="nav-item nav-link">Products</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                        <a href="404.php" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <div class=" d-none d-lg-flex">
                <div class="flex-shrink-0 btn-lg-square border border-light rounded-circle">
                    <a href="register.php">
                    <i class="fa fa-regular fa-user text-light"></i>
                    </a>
                </div>
                <div class="login-icon ps-3">
                    <small class="text-primary mb-0">
                        <?php
                            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
                            {
                                echo "Hi Guest!";
                            }

                            else
                            {
                                echo "Hi" . " " . $_SESSION["email"] . " !";
                            }
                        ?>
                    </small>
                </div>
            </div>
        </div>
    </nav>