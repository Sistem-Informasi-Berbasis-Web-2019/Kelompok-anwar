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
    $foto = $_POST['foto'];


    $qu = "INSERT INTO kasir VALUES ('$id_kasir', '$nama', '$alamat', '$telepon', '$status', '$username', '$password', '$acces', '$foto')";
    $con->exec($qu);
}
 
header("location:kasir.php");
?>