<?php
include_once '../fungsi.php';
session_start();

// cek apabila user mencoba mengakses langsung halaman ini
if (!isset($_SESSION['username']) AND (!isset($_SESSION['acces']))){
    header("Location: http://localhost/Uji_kompetensi/");



}
  ?>
<!DOCTYPE html>
<html>
<head>

	<title>Book Store</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>	
</head>
<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="http://www.malasngoding.com" class="navbar-brand">Book Store</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">				
				<ul class="nav navbar-nav navbar-right">
					<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan</a></li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Kasir By , <?php echo $_SESSION['nama']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	<div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan Notification</h4>
				</div>
				<div class="modal-body">
					<?php 
					   
					 $prepare = $con->prepare("SELECT * FROM buku where stok <= 3");
            $prepare->execute();
			foreach ($prepare as $data){	
						if($data['stok']==0){	
				
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok Buku <a style='color:red'>". $data[judul]."</a> yang tersisa sudah Habis . silahkan Tambah Pasokannya lagi !!</div>";	
						}elseif($data['stok']<=3){	
				
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok Buku <a style='color:red'>". $data[judul]."</a> yang tersisa sudah kurang dari 3 . silahkan Tambah Pasokannya lagi !!</div>";	
						}
					}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>						
				</div>
				
			</div>
		</div>
	</div>

<div class="col-md-2">
		<div class="row">
			<?php 
			$nama=$_SESSION['nama'];
			$prepare = $con->prepare("SELECT foto from kasir where nama='$nama'");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
				?>				

				<div class="col-xs-6 col-md-12">
					<a class="thumbnail">
						<img class="img-responsive" src="foto/<?php echo $data['foto']; ?>">
					</a>
				</div>
		
		</div>

		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>			
			<li><a href="barang_laku.php"><span class="glyphicon glyphicon-briefcase"></span>  Entry Penjualan</a></li>
			<li><a href="data_transaksi.php"><span class="glyphicon glyphicon-briefcase"></span> Data Penjualan</a></li>  
			<li><a href="barang.php"><span class="glyphicon glyphicon-briefcase"></span>  Data Buku</a></li>  
			<li><a href="ubah_foto.php"><span class="glyphicon glyphicon-lock"></span> Ubah Foto</a></li>   												
			<li><a href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Ubah Password</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>			
		</ul>
	</div>
	<div class="col-md-10">