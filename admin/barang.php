<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Buku</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Buku</button>
<a href="barang.php"><button style="margin-bottom:20px"  data-target="#myModal" class="btn btn-info col-md-2 rizky"><span class=""></span>Muat Ulang</button></a>

<br/>
<br/>

<?php 
$prepare = $con->prepare("SELECT * FROM buku where stok <= 3");
            $prepare->execute();
			foreach ($prepare as $data){	
						if($data['stok']<=0){	
		?>	
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
		<?php
		echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok Buku <a style='color:red'>". $data[judul]."</a> yang tersisa sudah habis . silahkan Tambah Pasokannya lagi !!</div>";	
	}elseif($data['stok']<=3){	
		?>	
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
		<?php
		echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok Buku <a style='color:red'>". $data[judul]."</a> yang tersisa sudah Kurang dari 3 . silahkan Tambah Pasokannya lagi !!</div>";	
	}
}
?>
<?php 
include_once '../fungsi.php';
$artikel = $con->prepare("SELECT * FROM buku");
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
			<td>Judul Buku</td>		
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
		<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
		</tr>
	</table>
	<a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
</div>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-3">Judul Buku</th>
		<th class="col-md-1">NO ISBN</th>
		<th class="col-md-1">Penulis</th>
		<th class="col-md-1">Harga Pokok</th>
		<th class="col-md-1">Harga Jual</th>
		<th class="col-md-1">Stok</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-3">Opsi</th>
	</tr>

	<?php 
	if(isset($_GET['cari'])){
		$cari=$_GET['cari'];
		$prepare = $con->prepare("SELECT * FROM buku WHERE judul LIKE '%$cari%' ORDER BY id_buku DESC");
            $prepare->execute();
	}else{
		$prepare = $con->prepare("SELECT * FROM buku limit $start, $per_hal");
            $prepare->execute();
	}
	$no=1;
	foreach ($prepare as $data) :

		?>
		<tr>
			<td><?php echo $no ?>.</td>
			<td><?php echo $data['judul'] ?></td>
			<td><?php echo $data['noisbn'] ?></td>
			<td><?php echo $data['penulis'] ?></td>
			<td>Rp.<?php echo number_format($data['harga_pokok']) ?></td>
			<td>Rp.<?php echo number_format($data['harga_jual']) ?></td>
			<td><?php echo $data['stok'] ?></td>
			<td>
				<a href="det_barang.php?id_buku=<?php echo $data['id_buku']; ?>" class="btn btn-info">Detail</a>
				<a href="edit.php?id_buku=<?php echo $data['id_buku']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id_buku=<?php echo $data['id_buku']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>	
		 <?php
		   $no++;
    endforeach;
    ?>	
	<tr>
	</tr>
	<tr>
		<td colspan="4">Jumlah Buku</td>
		<td></td>
		<td>			
		<?php 
		
			$prepare = $con->prepare("SELECT SUM(stok) AS total FROM buku");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);	
				?>	
			<b><?php echo $data['total']?></b>	Buku
		
		</td>
	</tr>
</table>
<ul class="pagination">			
			<?php 
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
				<h4 class="modal-title">Tambah Barang Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_brg_act.php" method="post">
				<div class="form-group">
						<input name="id_buku" type="hidden" class="form-control" placeholder="Nama Barang ..">
					</div>
					<div class="form-group">
						<label>Judul Buku</label>
						<input name="judul" type="text" class="form-control" placeholder="Judul Buku ..">
					</div>
					<div class="form-group">
						<label>NO ISBN</label>
						<input name="noisbn" type="text" class="form-control" placeholder="NO ISBN ..">
					</div>
					<div class="form-group">
						<label>Nama Penulis</label>
						<input name="penulis" type="text" class="form-control" placeholder="Nama Penulis ..">
					</div>
					<div class="form-group">
						<label>Penerbit</label>
						<input name="penerbit" type="text" class="form-control" placeholder="Penerbit ..">
					</div>	
					<div class="form-group">
						<label>Tahun Pembuatan</label>
						<input name="tahun" type="text" class="form-control" placeholder="Tahun Pembuatan ..">
					</div>	
					<div class="form-group">
						<label>Stok Buku</label>
						<input name="stok" type="text" class="form-control" placeholder="Stok Buku ..">
					</div>
					<div class="form-group">
						<label>Harga Pokok</label>
						<input name="harga_pokok" type="text" class="form-control" placeholder="Harga Pokok ..">
					</div>	
					<div class="form-group">
						<label>Harga Jual</label>
						<input name="harga_jual" type="text" class="form-control" placeholder="Harga Jual .." disabled>
					</div>	
					<div class="form-group">
						<label>Jumlah PPN</label>
						<input name="ppn" type="text" class="form-control" placeholder="0%..">
					</div>	
					<div class="form-group">
						<label>Jumlah Diskon</label>
						<input name="diskon" type="text" class="form-control" placeholder="0%..">
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