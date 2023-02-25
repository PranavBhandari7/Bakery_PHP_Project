<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="customers.php">
          <i class="bi bi-circle"></i><span>Customers</span>
        </a>
      </li>
      <li>
        <a href="feedbacks.php">
          <i class="bi bi-circle"></i><span>Customers Feedback</span>
        </a>
      </li>
      <li>
        <a href="admin.php">
          <i class="bi bi-circle"></i><span>Admin</span>
        </a>
      </li>
    </ul>
  </li><!-- End Users Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#categories-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="categories-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="categories.php">
          <i class="bi bi-circle"></i><span>Manage Categories</span>
        </a>
      </li>
      <li>
        <a href="addcategories.php">
          <i class="bi bi-circle"></i><span>Add Categories</span>
        </a>
      </li>
    </ul>
  </li><!-- End Categories Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#products-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="products-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="products.php">
          <i class="bi bi-circle"></i><span>Manage Products</span>
        </a>
      </li>
      <li>
        <a href="createproducts.php">
          <i class="bi bi-circle"></i><span>Add Products</span>
        </a>
      </li>
    </ul>
  </li><!-- End Products Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#orders-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Orders</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="orders-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="orders.php">
          <i class="bi bi-circle"></i><span>Orders</span>
        </a>
        <a href="manageorders.php">
          <i class="bi bi-circle"></i><span>Manage Orders</span>
        </a>
      </li>
    </ul>
  </li><!-- End Orders Nav -->

</ul>

</aside><!-- End Sidebar-->