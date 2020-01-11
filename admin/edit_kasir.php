<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Kasir</h3>
<a class="btn" href="kasir.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
if(isset($_GET)){
		if(!empty($_GET["id_kasir"])){
			$id_kasir = $_GET["id_kasir"];
			$query = "SELECT * FROM kasir WHERE id_kasir = ?";

			$prepare = $con->prepare($query);
			$prepare->bindParam(1, $id_kasir);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
		} else {
			header("Location: kasir.php");
		}
	} else {
		header("Location: kasir.php");
	}

?>				
	<form action="update_kasir.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_kasir" value="<?php echo $data['id_kasir'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Kasir</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $data['nama'] ?>"></td>
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
				<td>Status</td>
				<td><input type="text" class="form-control" name="status" value="<?php echo $data['status'] ?>"></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input type="text" class="form-control" name="username" value="<?php echo $data['username'] ?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" class="form-control" name="password" value="<?php echo $data['password'] ?>"></td>
			</tr>
			<tr>
				<td>Acces</td>
				<td><input type="text" class="form-control" name="acces" value="<?php echo $data['acces'] ?>"></td>
			</tr>
				<td> Foto</td>
			<td><div class="col-xs-6 col-md-12">
					<a class="thumbnail" href="edit_foto.php?id_kasir=<?php echo $data['id_kasir']; ?>">
						<img class="img-responsive" src="foto/<?php echo $data['foto'] ?>">
					</a>
				</div>
				</td>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>

<?php include 'footer.php'; ?>