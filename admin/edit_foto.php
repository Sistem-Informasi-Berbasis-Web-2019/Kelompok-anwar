<?php 
include 'header.php';
?>


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
			header("Location: edit_kasir.php");
		}
	} else {
		header("Location: edit_kasir.php");
	}

?>	
<h3><span class="glyphicon glyphicon-picture"></span>  Ganti Foto ,<?php echo $data['nama']; ?></h3>
<br/><br/>
<a class="btn" href="edit_kasir.php?id_kasir=<?php echo $data['id_kasir']; ?>"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<br/>
<h4><span class="glyphicon glyphicon-picture"></span>  Max foto berukuran 500*500</h4>
<div class="col-md-5 col-md-offset-3">
	<form action="act_edit_foto.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input name="nama" type="hidden" value="<?php echo $data['nama']; ?>">
		</div>
		<div class="form-group">
			<label>Foto</label>
			<input name="foto" type="file" class="form-control" placeholder="foto .." value="<?php echo $data['foto']; ?>>
		</div>		
		<div class="form-group">
			<label></label>
			<input type="submit" class="btn btn-info" value="Ganti">
			<input type="reset" class="btn btn-danger" value="reset">
		</div>																	
	</form>
</div>
<?php 
if(isset($_GET['pesan'])){
	$pesan=($_GET['pesan']);
	if($pesan=="oke"){
		echo "<div class='alert alert-success'>Foto berhasil di ganti !! </div>";
	}
}
?>
<?php 
include 'footer.php';

?>