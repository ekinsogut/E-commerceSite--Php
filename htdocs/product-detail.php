<!-- ---------------------------------------------------------------  -->
<?php 
require_once 'admin/pages/db.php';

@$detailid = intval($_GET['detailid']);
$getDetail = $db->prepare("SELECT * FROM `product` WHERE `id` = :id LIMIT 1");
$getDetail->bindValue("id" , $detailid , PDO::PARAM_INT);
$getDetail->execute();
$rowDetail = $getDetail->fetch(PDO::FETCH_ASSOC);
if($rowDetail["active"] == 0) {
  header("Location: index.php");
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

  <title><?= $row["name"] ?></title>

  <?php require 'css/boot.php' ?>
  <link href="style.css" rel="stylesheet">

</head>

<body>

  <?php require 'includes/inc-menu.php'; ?>

  <header class="masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div>
        <br>
          <div class="post-heading">
            <h1><?= $rowDetail["name"] ?></h1>
            <h5 class="subheading">Price: <?= $rowDetail["price"] ?></h5>
            <span class="meta"><?= $rowDetail["date"] ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <article>
    <div class="container">
      <div class="row">
        <div>
          <img src="./admin/pages/images/<?= $rowDetail["image"] ?>" alt="" margin: auto width="300" height="300">
          <?= htmlspecialchars_decode($rowDetail["description"]) ?>
        </div>
    </div>
  </article>

  <hr>

  <?php require 'css/js.php' ?>

</body>

</html>
