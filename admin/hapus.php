<?php
include '../fungsi.php';
if (isset($_GET['id_buku'])) {
    $con->exec("DELETE FROM buku WHERE id_buku = '$_GET[id_buku]'");
}
header("location:barang.php")
?>