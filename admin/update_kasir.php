<?php

include '../fungsi.php';
 
if (isset($_POST)) {
        $id_kasir = $_POST['id_kasir'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $status = $_POST['status'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $acces = $_POST['acces'];
    $sql = "UPDATE kasir SET nama = '$nama',
                                     alamat = '$alamat',
                                     telepon = '$telepon',
                                     status = '$status',
                                     username = '$username',
                                     password = '$password',
                                     acces = '$acces'
                                     WHERE id_kasir = '$id_kasir' ";
    $con->exec($sql);
}
 
header("location:kasir.php");

?>