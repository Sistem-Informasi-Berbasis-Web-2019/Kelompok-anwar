<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Barang</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
if(isset($_GET)){
		if(!empty($_GET["id_buku"])){
			$id_buku = $_GET["id_buku"];
			$query = "SELECT * FROM buku WHERE id_buku = ?";

			$prepare = $con->prepare($query);
			$prepare->bindParam(1, $id_buku);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
		} else {
			header("Location: barang.php");
		}
	} else {
		header("Location: barang.php");
	}

?>

				
	<table class="table">
		<tr>
			<td> Judul Buku</td>
			<td><?php echo $data['judul'] ?></td>
		</tr>
		<tr>
			<td>NO ISBN</td>
			<td><?php echo $data['noisbn'] ?></td>
		</tr>
		<tr>
			<td>Penulis</td>
			<td><?php echo $data['penulis'] ?></td>
		</tr>
		<tr>
			<td>Penerbit</td>
			<td><?php echo $data['penerbit'] ?></td>
		</tr>
		<tr>
			<td>Tahun Dibuat</td>
			<td><?php echo $data['tahun'] ?></td>
		</tr>
		<tr>
			<td>Stok Buku</td>
			<td><?php echo $data['stok'] ?></td>
		</tr>
		<tr>
			<td>Harga Pokok</td>
			<td>Rp.<?php echo number_format($data['harga_pokok']); ?>,-</td>
		</tr>
		<tr>
			<td>Harga Jual</td>
			<td>Rp.<?php echo number_format($data['harga_jual']) ?>,-</td>
		</tr>
		<tr>
			<td>PPN</td>
			<td><?php echo $data['ppn'] ?></td>
		</tr>
		<tr>
			<td>Diskon</td>
			<td><?php echo $data['diskon'] ?></td>
		</tr>
	</table>
<?php include 'footer.php'; ?>