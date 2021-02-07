<!-- ---------------------------------------------------------------  -->
<?php
require_once 'admin/pages/db.php';
session_start();
error_reporting(0);
$total_price = 0;
?>
<!-- ---------------------------------------------------------------  -->

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>My Cart</title>

  <?php require 'css/boot.php' ?>
  <link href="style.css" rel="stylesheet">

</head>

<body>

  <?php require 'includes/inc-menu.php'; ?>

    <!-- ---------------------------------------------------------------  -->
    <?php
    if($_SESSION["cart"] == NULL) {

      echo '<br>';
      echo '<h1>No Product</h1';

    } else {

      foreach ($_SESSION["cart"] as $id) {
        $getData = $db->prepare("SELECT * FROM `product` WHERE `id` = :id");
        $getData->bindValue(":id" , $id , PDO::PARAM_INT);
        $getData->execute();
        while($row = $getData-> fetch(PDO::FETCH_ASSOC)){
      ?>
    <div class="card-deck" >
      <div class="card">
        <div class="card-body" style="background-color: rgb(218, 223, 233);" >
            <img src="./admin/pages/images/<?= $row["image"] ?>" alt="" margin: auto width="160" height="160">
            <h4 class="card-title"><?= $row["name"] ?></h4>
            <?= $row["price"] ?> <br>
            <?= $row["date"] ?> <br> <br>
            <p><a href="cart.php?delcart=<?= $row["id"]?>" class="btn btn-outline-secondary">Remove to basket</a></p>
      </div>
    </div>
    <hr>
    <?php
        $totalprice = $totalprice + $row["price"];
        }
      }
    echo "<h1>Total Price: " . $totalprice . "TL</h1>";

    }
    ?>
    <!-- ---------------------------------------------------------------  -->

  <?php require 'css/js.php' ?>

</body>
</html>
