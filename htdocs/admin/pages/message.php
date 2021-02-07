<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Messages | Panel</title>

    <?php require_once './admincss/css.php'; ?>
</head>

<body>

    <!-- ---------------------------------------------------------------  -->
    <?php
    $id = intval(@$_GET["id"]);
    if(@$_GET["job"] == "clear") {

        $delete = $db->prepare("DELETE FROM `contact` WHERE `id` = :i");
        $delete->bindValue(":i" , $id , PDO::PARAM_INT);
        if($delete->execute()) {
            header("Location: message.php?i=add");
        } else {
            header("Location: message.php?i=err");
        }
    }
    ?>
    <!-- ---------------------------------------------------------------  -->

    <div id="wrapper">

        <?php require_once 'inc-menu.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inbox</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
                            if(@$_GET["i"] == "add") {

                                echo "<span class='text-success'>Adding Succesful!</span>";

                            } elseif(@$_GET["i"] == "err") {

                                echo "<span class='text-danger'>Adding Failed!</span>";
                            }
                            ?>
                        </div>

                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Seen</th>
                                            <th>Settings</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <!-- ---------------------------------------------------------------  -->
                                    <?php
                                    $getData = $db->prepare("SELECT * FROM `contact` ORDER BY `id` DESC");
                                    $getData->execute();

                                    while($row = $getData->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr class="gradeU">
                                            <td> <?= $row["id"] ?> </td>
                                            <td> <?= $row["name"] ?> </td>
                                            <td> <?= $row["email"] ?> </td>
                                            <td> <?= $row["phone"] ?> </td>
                                            <td class="center">

                                                <!-- Seen -->
                                                <?php if($row["seen"] == 1) { ?>
                                                <a class="btn btn-success">Read</a>
                                                <?php } else { ?>
                                                <a class="btn btn-danger">Not Read</a>
                                                <?php } ?>
                                                <!-- Seen -->

                                            </td>
                                            <td class="center">
                                                <a href="message-detail.php?id=<?=$row["id"]?>" style="margin-right: 15px;" class="btn btn-warning">Look Messages</a>
                                                <a href="message.php?job=clear&id=<?=$row["id"]?>" onclick="return confirm('Are you sure?')" style="margin-right: 15px;" class="btn btn-danger">Clear</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!-- ---------------------------------------------------------------  -->

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
