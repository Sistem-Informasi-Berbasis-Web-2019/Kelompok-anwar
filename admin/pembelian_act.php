<?php 

include '../fungsi.php';
if (isset($_POST['simpan'])) {
$id_pasok = $_POST['id_pasok'];
$id_kasir = $_POST['id_kasir'];
$id_distributor = $_POST['id_distributor'];
$id_buku = $_POST['id_buku'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];
$tanggal = $_POST['tanggal'];
    $qu = "INSERT INTO pasok VALUES ('$id_pasok', '$id_kasir', '$id_distributor', '$id_buku', '$harga', '$jumlah', '$total', '$tanggal')";
    $con->exec($qu);
}
 
header("location:pembelian.php");
?>