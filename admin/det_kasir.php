<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Kasir</h3>
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


				
	<table class="table">
	<tr>
			<td> Foto</td>
			<td><div class="col-xs-6 col-md-12">
					<a class="thumbnail">
						<img class="img-responsive" src="foto/<?php echo $data['foto'] ?>">
					</a>
				</div>
				</td>
		</tr>
		<tr>
			<td> Nama Kasir</td>
			<td><?php echo $data['nama'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?php echo $data['alamat'] ?></td>
		</tr>
		<tr>
			<td>Telepon</td>
			<td><?php echo $data['telepon'] ?></td>
		</tr>
		<tr>
			<td>Status</td>
			<td><?php echo $data['status'] ?></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><?php echo $data['username'] ?></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><?php echo $data['password'] ?></td>
		</tr>
	
		<tr>
			<td>Acces</td>
			<td><?php echo $data['acces'] ?></td>
		</tr>
	</table>
<?php include 'footer.php'; ?>