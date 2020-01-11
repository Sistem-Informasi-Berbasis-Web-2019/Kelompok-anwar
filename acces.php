<?php
session_start();

// cek apabila user mencoba mengakses langsung halaman ini
if (!isset($_SESSION['username']) AND (!isset($_SESSION['acces']))){
    header("Location: http://localhost/Uji_kompetensi/");
}


if ($_SESSION['acces']=='admin') {
	header('location:http://localhost/Book-store/admin/');
	
}

elseif ($_SESSION['acces']=='kasir') {
	header('location:http://localhost/Book-store/kasir/');
	
}



else { header('location: http://localhost/Book-store/');

 }

?>