<?php require_once 'db.php'?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <?php require_once './admincss/css.php'; ?>

</head>
<body>

    <div id="wrapper">

        <!-- ---------------------------------------------------------------  -->
        <?php require_once 'inc-menu.php';
        $messageNR = $db->prepare("SELECT * FROM `contact` WHERE `seen` = :o");
        $messageNR->bindValue(":o" , 0 , PDO::PARAM_INT);
        $messageNR->execute();
        $cntMessage = $messageNR->rowCount();
        $products = $db->prepare("SELECT * FROM `product`");
        $products->execute();
        $cntProducts = $products->rowCount();
        ?>
        <!-- ---------------------------------------------------------------  -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $cntMessage ?></div>
                                    <div>New Message!</div>
                                </div>
                            </div>
                        </div>
                        <a href="message.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $cntProducts ?></div>
                                    <div>Products!</div>
                                </div>
                            </div>
                        </div>
                        <a href="product.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once './admincss/js.php'; ?>

</body>
</html>