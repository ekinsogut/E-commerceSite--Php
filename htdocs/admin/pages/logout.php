<!-- ---------------------------------------------------------------  -->
<?php
session_start();
$_SESSION["logControl"] = 0;

session_unset();

header("Location: index.php?i=logout");
session_destroy();
?>
<!-- ---------------------------------------------------------------  -->