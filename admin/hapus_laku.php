<?php 
include '../fungsi.php';
if (isset($_GET['id_penjualan'])) {
    $con->exec("DELETE FROM penjualan WHERE id_penjualan = '$_GET[id_penjualan]'");
}
header("location:barang_laku.php")
?>