<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Transaksi Penjualan</h3>
<a href="data_transaksi.php"><button style="margin-bottom:20px"  data-target="#myModal" class="btn btn-info col-md-2 rizky"><span class=""></span>Muat Ulang</button></a>

<br/>
<br/>

<?php 
include_once '../fungsi.php';
$artikel = $con->prepare("SELECT * FROM penjualan");
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
			<td>Jumlah Transaksi</td>		
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
</div>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-3">ID Transaksi</th>
		<th class="col-md-1">Jumlah</th>
		<th class="col-md-1">Total</th>
		<th class="col-md-1">Bayar</th>
		<th class="col-md-1">Kembali</th>
		<th class="col-md-1">Tanggal</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-3">Opsi</th>
	</tr>

	<?php 
	if(isset($_GET['cari'])){
		$cari=$_GET['cari'];
		$prepare = $con->prepare("SELECT * FROM penjualan WHERE id_penjualan LIKE '%$cari%' ORDER BY id_penjualan DESC");
            $prepare->execute();
	}else{
		$prepare = $con->prepare("SELECT * FROM penjualan limit $start, $per_hal");
            $prepare->execute();
	}
	$no=1;
	foreach ($prepare as $data) :

		?>
		<tr>
			<td><?php echo $no ?>.</td>
			<td><?php echo $data['id_penjualan'] ?></td>
			<td><?php echo $data['jumlah'] ?></td>
			<td><?php echo $data['total'] ?></td>
			<td><?php echo $data['bayar'] ?></td>
			<td><?php echo $data['kembalian'] ?></td>
			<td><?php echo $data['tanggal'] ?></td>
			<td>
				<a href="det_penjualan.php?id_penjualan=<?php echo $data['id_penjualan']; ?>" class="btn btn-info">Detail</a>
				
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
			for($prepare=1;$prepare<=$halaman;$prepare++){
				?>
				<li><a href="?page=<?php echo $prepare ?>"><?php echo $prepare ?></a></li>
				<?php
			}
			?>						
		</ul>
<!-- modal input -->



<?php 
include 'footer.php';

?>