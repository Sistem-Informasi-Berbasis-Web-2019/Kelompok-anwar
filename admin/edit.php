<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Barang</h3>
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
	<form action="update.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_buku" value="<?php echo $data['id_buku'] ?>"></td>
			</tr>
			<tr>
				<td>Judul Buku</td>
				<td><input type="text" class="form-control" name="judul" value="<?php echo $data['judul'] ?>"></td>
			</tr>
			<tr>
				<td>No ISBN</td>
				<td><input type="text" class="form-control" name="noisbn" value="<?php echo $data['noisbn'] ?>"></td>
			</tr>
			<tr>
				<td>Penulis Buku</td>
				<td><input type="text" class="form-control" name="penulis" value="<?php echo $data['penulis'] ?>"></td>
			</tr>
			<tr>
				<td>Penerbit</td>
				<td><input type="text" class="form-control" name="penerbit" value="<?php echo $data['penerbit'] ?>"></td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td><input type="text" class="form-control" name="tahun" value="<?php echo $data['tahun'] ?>"></td>
			</tr>
			<tr>
				<td>Stok Buku</td>
				<td><input type="text" class="form-control" name="stok" value="<?php echo $data['stok'] ?>"></td>
			</tr>
			<tr>
				<td>Harga Pokok</td>
				<td><input type="text" class="form-control" name="harga_pokok" value="<?php echo $data['harga_pokok'] ?>"></td>
			</tr>
			<tr>
				<td>Harga Jual</td>
				<td><input type="text" class="form-control" name="harga_jual" value="<?php echo $data['harga_jual'] ?>" disabled></td>
			</tr>
			<tr>
				<td>PPN Buku</td>
				<td><input type="text" class="form-control" name="ppn" value="<?php echo $data['ppn'] ?>"></td>
			</tr>
			<tr>
				<td>Diskon</td>
				<td><input type="text" class="form-control" name="diskon" value="<?php echo $data['diskon'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>

<?php include 'footer.php'; ?>