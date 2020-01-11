<?php
include '../fungsi.php';
if (isset($_GET['id_penjualan'])) {
    $con->exec("DELETE FROM penjualan WHERE id_penjualan = '$_GET[id_penjualan]'");
$prepare = $con->prepare("DELETE FROM  detail_penjualan  WHERE id_penjualan = '$_GET[id_penjualan]'");
            $prepare->execute();
}
header("location:data_transaksi.php")
?>