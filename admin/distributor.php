<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Distributor</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Distributor</button>
<br/>
<br/>

<?php 
include_once '../fungsi.php';
$artikel = $con->prepare("SELECT * FROM distributor");
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
			<td>Jumlah Distributor</td>		
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
		<input type="text" class="form-control" placeholder="Cari nama distributor di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
		</tr>
	</table>
	<a style="margin-bottom:10px" href="lap_dtr.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
</div>

<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-4">Nama</th>
		<th class="col-md-1">Alamat</th>
		<th class="col-md-3">No Telepon</th>
		<th class="col-md-3">Opsi</th>
	</tr>

	<?php 
	if(isset($_GET['cari'])){
		$cari=$_GET['cari'];
		$prepare = $con->prepare("SELECT * FROM distributor WHERE nama_distributor LIKE '%$cari%' ORDER BY id_distributor DESC");
            $prepare->execute();
	}else{
		$prepare = $con->prepare("SELECT * FROM distributor limit $start, $per_hal");
            $prepare->execute();
	}
	$no=1;
	foreach ($prepare as $data) :

		?>
		<tr>
			<td><?php echo $no ?>.</td>
			<td><?php echo $data['nama_distributor'] ?></td>
			<td><?php echo $data['alamat'] ?></td>
			<td><?php echo $data['telepon'] ?></td>
			<td>
				<a href="edit_dtr.php?id_distributor=<?php echo $data['id_distributor']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_dtr.php?id_distributor=<?php echo $data['id_distributor']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>	
		 <?php
		   $no++;
    endforeach;
    ?>	
	<tr>
	</tr>
	<tr><td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td></tr>
</table>
<ul class="pagination">			
			<?php 
			$prepare = $con->prepare("SELECT * FROM distributor");
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
				<h4 class="modal-title">Tambah Distributor</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_dtr_act.php" method="post">
				<div class="form-group">
						<input name="id_distributor" type="hidden" class="form-control" placeholder="Nama Barang ..">
					</div>
					<div class="form-group">
						<label>Nama Distributor</label>
						<input name="nama_distributor" type="text" class="form-control" placeholder="Nama Distributor ..">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input name="alamat" type="text" class="form-control" placeholder="Alamat ..">
					</div>
					<div class="form-group">
						<label>No Telepon</label>
						<input name="telepon" type="text" class="form-control" placeholder="No Telepon ..">
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