<!-- ---------------------------------------------------------------  -->
<?php session_start();
if(@$_SESSION["logControl"] == 1) {
    header("Location: dashboard.php");
}
?>
<!-- ---------------------------------------------------------------  -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <?php require_once './admincss/css.php'; ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="******" name="password" type="password" required>
                                </div>
                                <input type="submit" name="submit" value="Login" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ---------------------------------------------------------------  -->
    <?php
        if(@$_POST["submit"]){
            if($_POST["username"] == "admin" && $_POST["password"] == 1234) {
                $_SESSION["logControl"] = 1;
                $_SESSION["username"] = $_POST["username"];
                header("Location: dashboard.php");
                return true;
            }
            else {
                echo "<p style='text-align: center; color: red;'>Username or password not correct!</p>";
                return false;
            }
        }
        if(@$_GET["i"] == "logout"){
            echo "<p style='text-align: center; color: green;'>Logout is OK!</p>";
        }
    ?>
    <!-- ---------------------------------------------------------------  -->

    <?php require_once './admincss/js.php'; ?>

</body>
</html>