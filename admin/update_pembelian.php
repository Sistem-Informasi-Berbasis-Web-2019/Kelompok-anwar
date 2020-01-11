<?php

include '../fungsi.php';
 
if (isset($_POST)) {
$id_pasok = $_POST['id_pasok'];
$id_kasir = $_POST['id_kasir'];
$id_distributor = $_POST['id_distributor'];
$id_buku = $_POST['id_buku'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];
$tanggal = $_POST['tanggal'];
    $sql = "UPDATE pasok SET id_kasir = '$id_kasir',
                                     id_buku = '$id_buku',
                                     harga = '$harga',
                                     jumlah = '$jumlah',
                                     total = '$total',
                                     tanggal = '$tanggal'
                                 WHERE id_pasok = '$id_pasok' ";
    $con->exec($sql);
}
 
header("location:pembelian.php");

?>