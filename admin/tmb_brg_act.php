<?php
include '../fungsi.php';
 
if (isset($_POST)) {
	$id_buku = $_POST['id_buku'];
	$judul = $_POST['judul'];
	$noisbn = $_POST['noisbn'];
	$penulis = $_POST['penulis'];
	$penerbit = $_POST['penerbit'];
	$tahun = $_POST['tahun'];
	$stok = $_POST['stok'];
	$harga_pokok = $_POST['harga_pokok'];
	$harga_jual = ($_POST['harga_pokok']+($_POST['harga_pokok']*$_POST['ppn']/100)-($_POST['harga_pokok']*$_POST['diskon']/100));
	$ppn = $_POST['ppn'];
$diskon = $_POST['diskon'];


    $qu = "INSERT INTO buku VALUES ('$id_buku', '$judul', '$noisbn', '$penulis', '$penerbit', '$tahun', '$stok', '$harga_pokok', '$harga_jual', '$ppn', '$diskon')";
    $con->exec($qu);
}
 
header("location:barang.php");
?>