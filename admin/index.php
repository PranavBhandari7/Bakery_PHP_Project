<?php 
    session_start();
    if(!isset($_SESSION['email']) == "admin@gmail.com") 
    {
      echo "<script>window.location.href='login.php';</script>";
      exit;
    } 
?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include('includes/adminHead.php') ?>
<!-- End Head -->

<body style="height:70rem">

  <!-- ======= Header ======= -->
  <?php include('includes/header.php') ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('includes/sidebar.php') ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
          <div class="row">

              <!-- Admins Card -->
              <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Admins</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="ps-3">
                    <div class="ps-3">
                      <?php
                        include("includes/config.php");
                        $sql = "SELECT COUNT(username) FROM admin";
                        $sqlQuery = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($sqlQuery))
                        { 
                          $admin = $row['COUNT(username)'];                            
                        }
                      ?>
                      <h6><?php echo $admin?></h6> 
                    </div>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Admin Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Registered Customers</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="ps-3">
                    <div class="ps-3">
                      <?php
                        $sql = "SELECT COUNT(username) FROM users";
                        $sqlQuery = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($sqlQuery))
                        { 
                          $users = $row['COUNT(username)'];                            
                        }
                      ?>
                      <h6><?php echo $users?></h6> 
                    </div>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Customers Card -->

            <!-- Orders Card -->
            <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">Total Orders</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                      $sql = "SELECT COUNT(order_id) FROM orders";
                      $query = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_array($query))
                      { 
                        $orders = $row['COUNT(order_id)'];                            
                      }
                    ?>
                    <h6><?php echo $orders?></h6> 
                  </div>
                </div>
              </div>

            </div>
            </div><!-- End Orders Card -->

            <!-- Categories Card -->
              <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Total Categories</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                    <i class="fa-solid fa-cake-candles text-primary"></i>
                    </div>
                    <div class="ps-3">
                    <div class="ps-3">
                      <?php
                        $sql = "SELECT COUNT(category_id) FROM categories";
                        $query = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($query))
                        { 
                          $categories = $row['COUNT(category_id)'];                            
                        }
                      ?>
                      <h6><?php echo $categories?></h6> 
                    </div>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Categories Card -->

            <!-- Customer Feedback -->

            <div class="accordion accordion-flush" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <div class="row">
                      <div class="col-6 text-start ps-4">
                        <h5 class="card-title">Customers Feedbacks</h5>
                        </button>
                      </div>
                      <div class="col-4 text-end">
                          <?php
                          include("includes/config.php");
                          $sql = "SELECT COUNT(feedback_id) FROM feedback";
                          $query = mysqli_query($conn,$sql);
                          while($row = mysqli_fetch_array($query))
                          { 
                            $feedback = $row['COUNT(feedback_id)'];                            
                          }
                        ?>
                        <h5 class="card-title"><?php echo $feedback . ' ' . 'Feedbacks'?></h5>                     
                      </div>
                      <div class="col-2 pe-4 pt-1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                          data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        </button>
                      </div>
                    </div>  
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" 
                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <div class="container">
                    <table class="table table-bordered text-center">
                      <thead class="bg-primary text-light">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Username</th>
                          <th scope="col">Ratings</th>
                          <th scope="col">Message</th>
                          <th scope="col">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $sqlcommand = "SELECT feedback.feedback_id,users.username,feedback.ratings,
                            feedback.message,feedback.feedback_date FROM users INNER JOIN feedback
                            ON users.user_id = feedback.user_id";
                            $query = mysqli_query($conn,$sqlcommand);
                            while($row = mysqli_fetch_array($query))
                            { 
                              echo "<tr>
                              <td class='fw-bold' style='font-size:0.8rem'>$row[feedback_id]</td>
                              <td class='fw-bold' style='font-size:0.8rem'>$row[username]</td>
                              <td class='fw-bold' style='font-size:0.8rem'>$row[ratings]</td>
                              <td class='text-primary fw-bold' style='font-size:0.8rem'>$row[message]</td>
                              <td class='fw-bold' style='font-size:0.8rem'>$row[feedback_date]</td>         
                              </tr>";                        
                            }
                        ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        <!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php include('includes/js.php') ?>
  <!-- End Vendor JS Files -->
</body>
</html>