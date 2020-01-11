<?php 
include '../fungsi.php';
if (isset($_GET['id_pasok'])) {
    $con->exec("DELETE FROM pasok WHERE id_pasok = '$_GET[id_pasok]'");
}
header("location:pembelian.php")
?>