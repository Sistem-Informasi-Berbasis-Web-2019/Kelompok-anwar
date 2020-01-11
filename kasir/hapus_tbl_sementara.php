<?php
include '../fungsi.php';
if (isset($_GET['id_buku'])) {
    $con->exec("DELETE FROM tbl_sementara_penjualan WHERE id_buku = '$_GET[id_buku]'");
}
header("location:barang_laku.php")
?>