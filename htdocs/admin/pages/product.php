<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product | Panel</title>

    <?php require_once './admincss/css.php'; ?>
</head>

<body>

    <!-- ---------------------------------------------------------------  -->
    <?php
    $id = intval(@$_GET["id"]);
    if(@$_GET["job"] == "active") {
        if($_GET["drm"] == 1) {
            $d = 0;
        } else {
            $d = 1;
        }
        $active = $db->prepare("UPDATE `product` SET `active` = :a WHERE `id` = :i");
        $active->bindValue(":a" , $d , PDO::PARAM_INT);
        $active->bindValue(":i" , $id , PDO::PARAM_INT );
        if($active->execute()) {
            header("Location: product.php?i=add");
        } else {
            header("Location: product.php?i=err");
        }
    }
    if(@$_GET["job"] == "clear") {
        $delete = $db->prepare("DELETE FROM `product` WHERE `id` = :i");
        $delete->bindValue(":i" , $id , PDO::PARAM_INT);
        if($delete->execute()) {
            header("Location: product.php?i=add");
        } else {
            header("Location: product.php?i=err");
        }
    }
    ?>
    <!-- ---------------------------------------------------------------  -->

    <div id="wrapper">

        <?php require_once 'inc-menu.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="product-add.php" style="margin-right: 15px;">New Add Product</a>

                            <!-- ---------------------------------------------------------------  -->
                            <?php
                            if(@$_GET["i"] == "add") {
                                echo "<span class='text-success'>Adding Succesful!</span>";
                            } elseif(@$_GET["i"] == "err") {
                                echo "<span class='text-danger'>Adding Failed!</span>";
                            }
                            ?>
                            <!-- ---------------------------------------------------------------  -->

                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Active</th>
                                            <th>Date</th>
                                            <th>Category</th>
                                            <th>Settings</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <!-- Get Product -->
                                    <?php
                                    $getData = $db->prepare("SELECT * FROM `product` ORDER BY `id` DESC");
                                    $getData->execute();

                                    while($row = $getData->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr class="gradeU">
                                            <td> <?= $row["id"] ?> </td>
                                            <td> <?= $row["name"] ?> </td>
                                            <td> <?= $row["price"] ?> </td>
                                            <td class="center">

                                                <!-- ---------------------------------------------------------------  -->
                                                <?php if($row["active"] == 1) { ?>
                                                <a href="product.php?job=active&id=<?=$row["id"]?>&drm=<?= $row["active"] ?>" onclick="return confirm('Change active inf?')" style="margin-right: 15px;" class="btn btn-success">Active</a> 
                                                <?php } else { ?>
                                                <a href="product.php?job=active&id=<?=$row["id"]?>&drm=<?= $row["active"] ?>" onclick="return confirm('Change active inf?')" style="margin-right: 15px;" class="btn btn-danger">Passive</a> 
                                                <?php } ?>
                                                <!-- ---------------------------------------------------------------  -->

                                            </td>
                                            <td> <?= $row["date"] ?> </td>
                                            <td> <?= $row["category"] ?> </td>
                                            <td class="center">
                                                <a href="product-edit.php?id=<?=$row["id"]?>" style="margin-right: 15px;" class="btn btn-warning">Edit</a>
                                                <a href="product.php?job=clear&id=<?=$row["id"]?>" onclick="return confirm('Are you sure?')" style="margin-right: 15px;" class="btn btn-danger">Clear</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!-- Get Product -->

                                    </tbody>
                                </table>
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
