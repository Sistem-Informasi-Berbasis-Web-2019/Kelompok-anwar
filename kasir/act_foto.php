<?php 
include_once '../fungsi.php';
$nama=$_POST['nama'];
$foto=$_FILES['foto']['name'];

// move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name'])or die();
// 	mysql_query("update admin set foto='$foto' where uname='$user'");


			$prepare = $con->prepare("SELECT * from kasir where nama='$nama'");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
if(file_exists("foto/".$data['foto'])){
	unlink("foto/".$data['foto']);
	move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
	$prepare = $con->prepare("UPDATE kasir SET foto='$foto' where nama='$nama'");
            $prepare->execute();
	header("location:ubah_foto.php?pesan=oke");
}else{
	move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
$prepare = $con->prepare("UPDATE kasir SET foto='$foto' where nama='$nama'");
            $prepare->execute();
	header("location:ubah_foto.php?pesan=oke");
}
?>