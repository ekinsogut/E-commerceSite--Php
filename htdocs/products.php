<!-- ---------------------------------------------------------------  -->
<?php
require_once 'admin/pages/db.php';
require_once 'operations.php';
    if (!isset($_SESSION['username'])) {
    header('location: login.php');
    }
    if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
    }
?>
<!-- ---------------------------------------------------------------  -->

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shopping</title>

  <?php require 'css/boot.php' ?>
  <link href="style.css" rel="stylesheet">

</head>

<body>

  <?php require 'includes/inc-menu.php'; ?>

  <div class="card-deck">

        <!-- ---------------------------------------------------------------  -->
        <?php
        $word = $_GET["search"];

        if ($word != "") {

          echo "<hr>";
          echo "<h4>Searched Word: <strong> $word </strong> | <a href='products.php' class='btn btn-outline-secondary'>Go Back Home Page</a></h4>";

          $getData = $db->prepare("SELECT * FROM `product` WHERE `active` = :active && `name` LIKE :search ORDER BY `id`");
          $getData->bindValue(":active" , 1 , PDO::PARAM_INT);
          $getData->bindValue(":search" , "%$word%" , PDO::PARAM_STR);

        }elseif(isset($_GET["catphone"])) {
          $phone = "Phone";
          $getData = $db->prepare("SELECT * FROM `product` WHERE `category` = :category ORDER BY `id` DESC");
          $getData->bindValue(":category" , $phone , PDO::PARAM_STR);
        }elseif(isset($_GET["catcomputer"])) {
          $computer = "Computer";
          $getData = $db->prepare("SELECT * FROM `product` WHERE `category` = :category ORDER BY `id` DESC");
          $getData->bindValue(":category" , $computer , PDO::PARAM_STR);
        }else {
          $getData = $db->prepare("SELECT * FROM `product` WHERE `active` = :active ORDER BY `id` DESC");
          $getData->bindValue(":active" , 1 , PDO::PARAM_INT);
        }

        $getData->execute();

        while($row = $getData-> fetch(PDO::FETCH_ASSOC)){
        ?>

        <div class="card-deck">
          <div class="card">
            <div class="card-body" style="background-color: rgb(218, 223, 233);" >
                <img src="./admin/pages/images/<?= $row["image"] ?>" alt="" margin: auto width="320" height="320">
                <h4 class="card-title"><?= $row["name"] ?></h4>
                <?= $row["price"] ?> TL<br>
                <?= $row["date"] ?> <br> <br>
                <p><a href="product-detail.php?detailid=<?= $row["id"]?>" class="btn btn-outline-secondary">Go detail</a></p>
                <p><a href="cart.php?idforcart=<?= $row["id"]?>" class="btn btn-outline-secondary">Add to basket</a></p>

            </div>
          </div>
        <br>
        <?php }?>
        <!-- ---------------------------------------------------------------  -->

  </div>

  <?php require 'css/js.php' ?>

</body>
</html>
