<?php 
include_once '../fungsi.php';

$user=$_POST['user'];
$lama=$_POST['lama'];
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];
$prepare = $con->prepare("SELECT * FROM kasir WHERE password='$lama' AND username='$user'");
            $prepare->execute();
if($prepare==1){
	if($baru==$ulang){
		$b = $baru;
		$prepare = $con->prepare("UPDATE kasir SET password='$b' WHERE username='$user'");
            $prepare->execute();
		header("location:ganti_pass.php?pesan=oke");
	}else{
		header("location:ganti_pass.php?pesan=tdksama");
	}
}else{
	header("location:ganti_pass.php?pesan=gagal");
}

 ?>