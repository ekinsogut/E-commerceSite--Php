<!-- ---------------------------------------------------------------  -->
<?php 
require_once 'admin/pages/db.php';

if(@$_POST["sContact"]) {

  $name = htmlspecialchars($_POST["name"] , ENT_QUOTES , 'UTF-8');
  $email = htmlspecialchars($_POST["email"] , ENT_QUOTES , 'UTF-8');
  $phone = htmlspecialchars($_POST["phone"] , ENT_QUOTES , 'UTF-8');
  $message = htmlspecialchars($_POST["message"] , ENT_QUOTES , 'UTF-8');

  $addContact = $db->prepare("INSERT INTO `contact` (`name`,`email`,`phone`,`message`) VALUES (:name , :email , :phone , :message)");
  $addContact->bindValue(":name" , $name , PDO::PARAM_STR);
  $addContact->bindValue(":email" , $email , PDO::PARAM_STR);
  $addContact->bindValue(":phone" , $phone , PDO::PARAM_INT);
  $addContact->bindValue(":message" , $message , PDO::PARAM_STR);

  if($addContact->execute()) {
    header("Location: contact.php?i=ok");
  } else {
    header("Location: contact.php?i=err");
  }
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

  <title>Contact</title>

  <?php require 'css/boot.php' ?>
  <link href="style.css" rel="stylesheet">

</head>
<body>

  <?php require 'includes/inc-menu.php'; ?>

  <h1>Contact</h1>
  <hr>
        <form method="POST">
          <div class="control-group">
            <div>
              <label>Name Surname</label>
              <input type="text" class="form-control" placeholder="Name" name="name" required data-validation-required-message="Please enter your name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" name="email" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group">
              <label>Phone Number</label>
              <input type="tel" class="form-control" placeholder="Phone Number" name="phone" required data-validation-required-message="Please enter your phone number.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group">
              <label>Message</label>
              <textarea rows="5" class="form-control" placeholder="Message" name="message" required data-validation-required-message="Please enter a message."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
            <div class="form-group">
              <input type="submit" name="sContact" class="btn btn-outline-secondary" value="SEND">
            </div>

            <div id="notification"></div>
        </form>
  <hr>

  <!-- ---------------------------------------------------------------  -->
  <?php
    if(@$_GET["i"] == "ok") {
      echo '<p class="text-center alert alert-success">Sending message Succesful!</p>';
    } elseif(@$_GET["i"] == "err") {
      echo '<p class="text-center alert alert-success">Sending message Failed!</p>';
    }
  ?>
  <!-- ---------------------------------------------------------------  -->

  <?php require 'css/js.php' ?>

</body>
</html>
