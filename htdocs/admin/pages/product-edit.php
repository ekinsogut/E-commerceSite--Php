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
    $getwID = $db->prepare("SELECT * FROM `product` WHERE `id` = :id");
    $getwID->bindValue(":id" , $id , PDO::PARAM_INT);
    $getwID->execute();
    $row = $getwID->fetch(PDO::FETCH_ASSOC);

    if(@$_POST["submit"]){

        $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($_POST["price"], ENT_QUOTES, 'UTF-8');
        $category = htmlspecialchars($_POST["category"], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');

        $image = $_FILES["image"]["name"];
        $target = "images/".basename($_FILES['image']['name']);

        $active = htmlspecialchars($_POST["active"], ENT_QUOTES, 'UTF-8');
        $update = $db->prepare("UPDATE `product` SET `name` = :name , `price` = :price ,`description` = :description , `image` = :image , `category` = :category ,`active` = :active WHERE `id` = :id");
        $update->bindValue(":name" , $name , PDO::PARAM_STR);
        $update->bindValue(":price" , $price , PDO::PARAM_INT);
        $update->bindValue(":category" , $category , PDO::PARAM_STR);
        $update->bindValue(":description" , $description , PDO::PARAM_STR);
        $update->bindValue(":image" , $image , PDO::PARAM_STR);
        $update->bindValue(":active" , $active , PDO::PARAM_INT);
        $update->bindValue(":id" , $id , PDO::PARAM_INT);

        if($update->execute()) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
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
                    <h1 class="page-header">Edit Product (<?= $id ?>)</h1>
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
                                            <input class="form-control" value="<?=$row["name"]?>" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label>Price</label>
                                            <input class="form-control" value="<?=$row["price"]?>" name="price">
                                        </div>

                                        <div class="form-group">
                                            <label>Category</label>
                                            <input class="form-control" value="<?=$row["category"]?>" name="category">
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="description_textarea" rows="3"><?=$row["description"]?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" value="<?=$row["image"]?>" name="image">
                                        </div>
                                        <div class="form-group">
                                            <label>Active</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="active" value="1"
                                                    <?php echo ($row["active"] == 1) ? 'checked' : '';?>
                                                    >Active
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="active" value="0"
                                                    <?php echo ($row["active"] == 0) ? 'checked' : '';?>
                                                    >Passive
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
