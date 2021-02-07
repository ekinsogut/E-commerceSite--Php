<!-- ---------------------------------------------------------------  -->
<?php
require_once 'admin/pages/db.php';
$getAbout = $db->prepare("SELECT * FROM `about` ORDER BY `id` DESC LIMIT 1");
$getAbout->execute();
$rowAbout = $getAbout->fetch(PDO::FETCH_ASSOC);
?>
<!-- ---------------------------------------------------------------  -->

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>About</title>

  <?php require 'css/boot.php' ?>
  <link href="style.css" rel="stylesheet">

</head>

<body>

  <?php require 'includes/inc-menu.php'; ?>

  <h1>About</h1>
  <hr>
  <div class="a" ><?= htmlspecialchars_decode($rowAbout["description"]) ?></div>

  <?php require 'css/js.php' ?>

</body>
</html>
