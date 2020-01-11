<?php

include '../fungsi.php';
 
if (isset($_POST)) {
$id_penjualan = $_POST['id_penjualan'];
$kasir = $_POST['kasir'];
$id_buku = $_POST['id_buku'];
$harga_pokok = $_POST['harga_pokok'];
$harga_jual = $_POST['harga_jual'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];
$bayar = $_POST['bayar'];
$kembali = $_POST['kembali'];
$laba = $_POST['laba'];
$tanggal = $_POST['tanggal'];
    $sql = "UPDATE penjualan SET id_kasir = '$kasir',
                                     id_buku = '$id_buku',
                                     jumlah = '$jumlah',
                                     total = '$total',
                                     bayar = '$bayar',
                                     kembali = '$kembali',
                                     laba = '$laba',
                                     tanggal = '$tanggal'
                                 WHERE id_penjualan = '$id_penjualan' ";
    $con->exec($sql);
}
 
header("location:barang_laku.php");

?>