<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Pemasokan Buku</h3>
<a class="btn" href="pembelian.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
if(isset($_GET)){
		if(!empty($_GET["id_pasok"])){
			$id_pasok = $_GET["id_pasok"];
			$query = "SELECT * FROM lap_pembelian WHERE id_pasok = ?";

			$prepare = $con->prepare($query);
			$prepare->bindParam(1, $id_pasok);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
		} else {
			header("Location: pembelian.php");
		}
	} else {
		header("Location: pembelian.php");
	}

?>

				
	<table class="table">
<tr>
			<td>Nama Kasir </td>
			<td><?php echo $data['nama'] ?></td>
		</tr>
	<tr>
			<td> Distributor</td>
			<td><?php echo $data['nama_distributor'] ?></td>
		</tr>
		<tr>
			<td>Judul Buku</td>
			<td><?php echo $data['judul'] ?></td>
		</tr>
		<tr>
			<td>NO ISBN</td>
			<td><?php echo $data['noisbn'] ?></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>Rp.<?php echo number_format($data['harga']) ?></td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td><?php echo $data['jumlah'] ?></td>
		</tr>
		<tr>
			<td>Total Harga</td>
			<td>Rp.<?php echo number_format($data['total']) ?></td>
		</tr>
		<tr><td>Cetak</td>
		<td><a href="lap_det_pembelian.php?id_pasok=<?php echo $data['id_pasok']; ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Transaksi</a>
</td></tr>
	</table>
<?php include 'footer.php'; ?>