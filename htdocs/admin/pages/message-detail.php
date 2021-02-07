<?php require_once 'db.php'?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product Edit | Panel</title>

    <?php require_once './admincss/css.php'; ?>

</head>

<body>

    <!-- ---------------------------------------------------------------  -->
    <?php
    @$id = $_GET["id"];
    $seen = $db->prepare("UPDATE `contact` SET `seen` = :a WHERE `id` = :i");
    $seen->bindValue(":a" , 1 , PDO::PARAM_INT);
    $seen->bindValue(":i" , $id , PDO::PARAM_INT );
    $seen->execute();
    $getwID = $db->prepare("SELECT * FROM `contact` WHERE `id` = :id");
    $getwID->bindValue(":id" , $id , PDO::PARAM_INT);
    $getwID->execute();
    $row = $getwID->fetch(PDO::FETCH_ASSOC);
    ?>
    <!-- ---------------------------------------------------------------  -->

    <div id="wrapper">

        <?php require_once 'inc-menu.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Message (<?= $id ?>)</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="message.php">Go Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                        <div class="form-group">
                                            <p><b>Name:<?=$row["name"]?></b></p>
                                            <p><b>Email:<?=$row["email"]?></b></p>
                                            <p><b>Phone:<?=$row["phone"]?></b></p>
                                            <p><b>Message:<?=$row["message"]?></b></p>
                                        </div>

                                        <a href="message.php?job=clear&id=<?=$row["id"]?>" onclick="return confirm('Are you sure?')" style="margin-right: 15px;" class="btn btn-danger">Clear</a>
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
