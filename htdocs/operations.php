<?php 

require_once 'admin/pages/db.php';

session_start();

//register-------------------------------------------------------
error_reporting(0);
if(@$_POST["register"]) {

    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    $check = $db->prepare("SELECT * FROM `users` WHERE `username` = :username AND `password` = :password");

    $check->bindValue(":username",$username,PDO::PARAM_STR);
    $check->bindValue(":password",$password,PDO::PARAM_STR);
    $check->execute();

    $row = $check-> fetch(PDO::FETCH_ASSOC);

    if($row["username"] && $row["password"]) {
      if($row["username"] == $username) {
        array_push($errors, "Username already exists");
      }
    }

    if (count($errors) == 0){

      $add = $db->prepare("INSERT INTO `users` (`username`,`password`) VALUES (:name , :password)");

      $add->bindValue(":name",$username,PDO::PARAM_STR);
      $add->bindValue(":password",$password,PDO::PARAM_STR);

      if($add -> execute()) {
          header("Location: login.php");
      }
    }
}



//login----------------------------------------------------------
if(@$_POST["login"]) {

    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

    if (empty($username)) {array_push($errors, "Username is required");}
    if (empty($password)) {array_push($errors, "Password is required");}

    if (count($errors) == 0){

        $log = $db->prepare("SELECT * FROM `users` WHERE `username` = :username AND `password` = :password");
        $log->bindValue(":username",$username,PDO::PARAM_STR);
        $log->bindValue(":password",$password,PDO::PARAM_INT);

        $log -> execute();
        $row = $log-> fetch(PDO::FETCH_ASSOC);
        if($username == $row["username"]) {

            $_SESSION['username'] = $username;
            header("Location: products.php");

        } else {

            header("Location: login.php");
        }
    }
}

?>