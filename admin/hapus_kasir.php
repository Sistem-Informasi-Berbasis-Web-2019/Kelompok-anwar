<?php
include '../fungsi.php';
if (isset($_GET['id_kasir'])) {
    $con->exec("DELETE FROM kasir WHERE id_kasir = '$_GET[id_kasir]'");
}
header("location:kasir.php")
?>