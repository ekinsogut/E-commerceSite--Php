<?php require_once 'db.php'?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product Add | Panel</title>

    <?php require_once './admincss/css.php'; ?>
</head>

<body>

    <!-- ---------------------------------------------------------------  -->
    <?php
    if(@$_POST["submit"]){
        $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($_POST["price"], ENT_QUOTES, 'UTF-8');
        $category = htmlspecialchars($_POST["price"], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');

        $image = $_FILES["image"]["name"];
        $target = "images/".basename($_FILES['image']['name']);

        $active = htmlspecialchars($_POST["active"], ENT_QUOTES, 'UTF-8');
        $add = $db->prepare("INSERT INTO `product` (`name`,`price`, `category` ,`description`,`image`,`active`) VALUES (:name, :price , :category ,:description , :image , :active)");

        $add->bindValue(":name",$name,PDO::PARAM_STR);
        $add->bindValue(":price",$price,PDO::PARAM_STR);
        $add->bindValue(":category",$category,PDO::PARAM_STR);
        $add->bindValue(":description",$description,PDO::PARAM_STR);
        $add->bindValue(":image",$image,PDO::PARAM_STR);
        $add->bindValue(":active",$active,PDO::PARAM_STR);
        if($add->execute()) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            header("Location: product.php?i=add");
        } else {
            header("Location: product.php?i=err");
        }
    } ?>
    <!-- ---------------------------------------------------------------  -->

    <div id="wrapper">

        <?php require_once 'inc-menu.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Product</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="product.php">Go Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="POST" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label>Price</label>
                                            <input class="form-control" name="price">
                                        </div>

                                        <div class="form-group">
                                            <label>Category</label>
                                            <input class="form-control" name="category">
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="description_textarea" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image">
                                        </div>
                                        <div class="form-group">
                                            <label>Active</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="active" value="1" checked>Active
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="active" value="0">Passive
                                                </label>
                                            </div>
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
