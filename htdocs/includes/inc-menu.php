<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="products.php">Shopping</a>
      <button class="navbar-toggler navbar-toggler-right" type="button">
      </button>
      <div>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php?catphone">Phone</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php?catcomputer">Computer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shopping-cart.php"><strong>My Basket</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php?logout='1'">Logout</a>
          </li>
          <form action="products.php" method="GET">
            <input type="text" name="search" placeholder="Search.." class="form-control">
          </form>

        </ul>
      </div>
    </div>
  </nav>

