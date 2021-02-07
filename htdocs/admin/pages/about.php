<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About Us | Panel</title>

    <?php require_once './admincss/css.php'; ?>
</head>

<body>

    <!-- ---------------------------------------------------------------  -->
    <?php
    if(@$_POST["submit"]){
        $delete = $db->prepare("DELETE FROM `about`");
        $delete->execute();
        $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
        $add = $db->prepare("INSERT INTO `about` (`description`) VALUES (:description)");
        $add->bindValue(":description",$description,PDO::PARAM_STR);
        if($add->execute()) {
            header("Location: about.php?i=add");
        } else {
            header("Location: about.php?i=err");
        }
    }
    $getwID = $db->prepare("SELECT * FROM `about` ORDER BY `id` DESC LIMIT 1");
    $getwID->execute();
    $row = $getwID->fetch(PDO::FETCH_ASSOC);
    ?>
    <!-- ---------------------------------------------------------------  -->

    <div id="wrapper">

        <?php require_once 'inc-menu.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">About Us</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="dashboard.php">Go Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" role="form" method="POST">

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="description_textarea" rows="3"><?= $row["description"] ?></textarea>
                                        </div>

                                        <input type="submit" name="submit" value="Submit" class="btn btn-default">
                                        <button type="reset" class="btn btn-default">Clear</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once './admincss/js.php'; ?>

</body>
</html>
