<!-- ---------------------------------------------------------------  -->
<?php

session_start();

if(empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if($_GET['delcart'] != NULL) {
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i] == $_GET['delcart']) {
        unset($_SESSION['cart'][$i]);
        }
    }
}

if($_GET['idforcart'] != NULL) {
array_push($_SESSION['cart'] , $_GET['idforcart'] );
}

header("Location: products.php");
?>
<!-- ---------------------------------------------------------------  -->











