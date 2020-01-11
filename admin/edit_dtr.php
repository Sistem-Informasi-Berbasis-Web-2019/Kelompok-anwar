<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Dat Distributor</h3>
<a class="btn" href="distributor.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
if(isset($_GET)){
		if(!empty($_GET["id_distributor"])){
			$id_distributor = $_GET["id_distributor"];
			$query = "SELECT * FROM distributor WHERE id_distributor = ?";

			$prepare = $con->prepare($query);
			$prepare->bindParam(1, $id_distributor);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
		} else {
			header("Location: distributor.php");
		}
	} else {
		header("Location: distributor.php");
	}

?>				
	<form action="update_dtr.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_distributor" value="<?php echo $data['id_distributor'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Distributor</td>
				<td><input type="text" class="form-control" name="nama_distributor" value="<?php echo $data['nama_distributor'] ?>"></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat'] ?>"></td>
			</tr>
			<tr>
				<td>No Telepon</td>
				<td><input type="text" class="form-control" name="telepon" value="<?php echo $data['telepon'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>

<?php include 'footer.php'; ?>