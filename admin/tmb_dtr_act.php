<?php
include '../fungsi.php';
 
if (isset($_POST)) {
	$id_distributor = $_POST['id_distributor'];
	$nama_distributor = $_POST['nama_distributor'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];


    $qu = "INSERT INTO distributor VALUES ('$id_distributor', '$nama_distributor', '$alamat', '$telepon')";
    $con->exec($qu);
}
 
header("location:distributor.php");
?>