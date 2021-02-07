<?php require_once 'operations.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <?php require 'css/boot.php' ?>
    <link href="style.css" rel="stylesheet">

</head>
<body>

<header>
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div>
          <div class="site-heading">
            <br>
            <h1>Register</h1>
            <span class="subheading">E-commerce site <a class="nav-link" href="admin/pages/index.php" class="btn btn-default">Click for Admin</a> </span>

            <hr>

            <form role="form" action="" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password"  class="form-control" name="password">
                </div>
                <br>
                <input type="submit" name="register" value="Submit" class="btn btn-outline-secondary">

                <br><br>
                Already a member? <br> <br> <a href="login.php" class="btn btn-outline-secondary">Sign in</a>

                <br> <br>

                <?php include('errors.php'); ?>

            </form>
          </div>
        </div>
      </div>
    </div>
  </header>

<?php require 'css/js.php' ?>

</body>
</html>