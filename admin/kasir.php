<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Kasir</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Kasir</button>
<a href="kasir.php"><button style="margin-bottom:20px"  data-target="#myModal" class="btn btn-info col-md-2 rizky"><span class=""></span>Muat Ulang</button></a>

<br/>
<br/>

<?php 
include_once '../fungsi.php';
$artikel = $con->prepare("SELECT * FROM kasir");
$artikel->execute();
$jumlahdata = $artikel->rowCount();
$per_hal=10;
$halaman=ceil($jumlahdata / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Jumlah Kasir</td>		
			<td><?php echo $jumlahdata; ?></td>
		</tr>
			<tr>
			<td>Jumlah Halaman</td>	
			<td><?php echo $halaman; ?></td>
		</tr>
		<tr>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari nama di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
		</tr>
	</table>
	
</div>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-3">Nama</th>
		<th class="col-md-1">Alamat</th>
		<th class="col-md-1">Telepon</th>
		<th class="col-md-1">Status</th>
		<th class="col-md-1">Acces</th>	 
		<th class="col-md-3">Opsi</th>
	</tr>

	<?php 
	if(isset($_GET['cari'])){
		$cari=$_GET['cari'];
		$prepare = $con->prepare("SELECT * FROM kasir WHERE nama LIKE '%$cari%' ORDER BY id_kasir DESC");
            $prepare->execute();
	}else{
		$prepare = $con->prepare("SELECT * FROM kasir limit $start, $per_hal");
            $prepare->execute();
	}
	$no=1;
	foreach ($prepare as $data) :

		?>
		<tr>
			<td><?php echo $no ?>.</td>
			<td><?php echo $data['nama'] ?></td>
			<td><?php echo $data['alamat'] ?></td>
			<td><?php echo $data['telepon'] ?></td>
			<td><?php echo $data['status'] ?></td>
			<td><?php echo $data['acces'] ?></td>
			<td>
				<a href="det_kasir.php?id_kasir=<?php echo $data['id_kasir']; ?>" class="btn btn-info">Detail</a>
				<a href="edit_kasir.php?id_kasir=<?php echo $data['id_kasir']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_kasir.php?id_kasir=<?php echo $data['id_kasir']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>	
		 <?php
		   $no++;
    endforeach;
    ?>	
	<tr>
	</tr>
	
</table>
<ul class="pagination">			
			<?php 
			$prepare = $con->prepare("SELECT * FROM kasir ");
            $prepare->execute();
			for($prepare=1;$prepare<=$halaman;$prepare++){
				?>
				<li><a href="?page=<?php echo $prepare ?>"><?php echo $prepare ?></a></li>
				<?php
			}
			?>						
		</ul>
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Kasir Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_kasir_act.php" method="post">
				<div class="form-group">
						<input name="id_kasir" type="hidden" class="form-control" placeholder="Nama Barang ..">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama ..">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input name="alamat" type="text" class="form-control" placeholder="Alamat ..">
					</div>
					<div class="form-group">
						<label>No Telepon</label>
						<input name="telepon" type="text" class="form-control" placeholder="No Telepon ..">
					</div>
					<div class="form-group">
						<label>Status</label>
						<input name="status" type="text" class="form-control" placeholder="Status ..">
					</div>	
					<div class="form-group">
						<label>Username</label>
						<input name="username" type="text" class="form-control" placeholder="Username ..">
					</div>	
					<div class="form-group">
						<label>Password</label>
						<input name="password" type="text" class="form-control" placeholder="Password ..">
					</div>
					<div class="form-group">
						<label>Acces</label>
						<input name="acces" type="text" class="form-control" placeholder="Acces ..">
					</div>		
							<div class="form-group">
			<label>Foto</label>
			<input name="foto" type="file" class="form-control" placeholder="foto ..">
		</div>																	

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>



<?php 
include 'footer.php';

?>