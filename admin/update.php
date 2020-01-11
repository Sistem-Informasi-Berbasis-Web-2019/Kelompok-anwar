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
    $sql = "UPDATE buku SET judul = '$judul',
                                     noisbn = '$noisbn',
                                     penulis = '$penulis',
                                     penerbit = '$penerbit',
                                     tahun = '$tahun',
                                     stok = '$stok',
                                     harga_pokok = '$harga_pokok',
                                     harga_jual = '$harga_jual',
                                     ppn = '$ppn',
                                     diskon = '$diskon'
                                 WHERE id_buku = '$id_buku' ";
    $con->exec($sql);
}
 
header("location:barang.php");

?>