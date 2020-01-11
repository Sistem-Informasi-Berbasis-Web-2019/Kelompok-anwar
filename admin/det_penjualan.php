<?php include 'header.php';	?>
<table class="table">
<tr>
<td colspan="7"><h3><span class="glyphicon glyphicon-briefcase"></span>  Laporan Penjualan</h3></td>
<td></td>
<td>
<?php
if(isset($_GET)){
		if(!empty($_GET["id_penjualan"])){
			$id_penjualan = $_GET["id_penjualan"];
			$query = "SELECT * FROM penjualan WHERE id_penjualan = ?";

			$prepare = $con->prepare($query);
			$prepare->bindParam(1, $id_penjualan);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
		} else {
			header("Location: barang.php");
		}
	}

?>
<div class="form-group">
						<label>NO Transakasi.</label>
							<input name="id_penjualan" type="text" class="form-control" value="<?php echo $data['id_penjualan'] ?>" readonly>
						</div>
					
						
</td>
<td><label>Tanggal Transaksi.</label>
<input name="tanggal" value="<?php echo $data['tanggal'] ?>" type="text" class="form-control" readonly></td>
</tr>
</table>

	<br/>

<table class="table">
	<tr>
		<th>No</th>
		<th>ID Buku</th>
		<th>Judul Buku</th>
		<th>Harga</th>
		<th>Jumlah</th>
		<th>Total</th>						
		
	</tr>

	<?php 
	if(isset($_GET['id_penjualan'])){
		$id_penjualan=$_GET['id_penjualan'];
		$prepare = $con->prepare("SELECT * FROM detail_penjualan WHERE id_penjualan ORDER BY id_penjualan DESC");
            $prepare->execute();
	}
	$no=1;
	foreach ($prepare as $data) :

		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $data['id_buku'] ?></td>
			<td><?php echo $data['judul'] ?></td>
			<td><?php echo "Rp.".number_format($data['harga']).""?></td>
			<td><?php echo $data['jumlah'] ?></td>			
			<td><?php echo "Rp.".number_format($data['total']).""?></td>
		
			
		</tr>
	 <?php
		   $no++;
		   endforeach;
		       ?>	
	<tr>
		<td colspan="5">Total</td>
		<?php
		if(isset($_GET['id_penjualan'])){
			$id_penjualan=$_GET['id_penjualan'];	
			$prepare = $con->prepare("SELECT sum(total) as total from detail_penjualan where id_penjualan='$id_penjualan'");
            $prepare->execute();
            $data = $prepare->fetch(PDO::FETCH_ASSOC);
            echo "<td><b> Rp.". number_format($data['total']).",-</b></td>";
        }
        
		?>
		
	</tr>
	<tr>
	<td colspan="5">Cetak</td>	
			<td>
		<?php
		if(isset($_GET['id_penjualan'])){
	$id_penjualan=$_GET['id_penjualan'];
	$prepare = $con->prepare("SELECT * from penjualan where id_penjualan='$id_penjualan'");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
}
?>
<a href="lap_det_penjualan.php?id_penjualan=<?php echo $data['id_penjualan']; ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Transaksi</a>
</td>
	</tr>
</table>

	<?php include 'footer.php'; ?>