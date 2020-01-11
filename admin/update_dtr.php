<?php

include '../fungsi.php';
 
if (isset($_POST)) {
    $id_distributor = $_POST['id_distributor'];
    $nama_distributor = $_POST['nama_distributor'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $sql = "UPDATE distributor SET nama_distributor = '$nama_distributor',
                                     alamat = '$alamat',
                                     telepon = '$telepon'
                                 WHERE id_distributor = '$id_distributor' ";
    $con->exec($sql);
}
 
header("location:distributor.php");

?>