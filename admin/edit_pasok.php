<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Data Pemasokan Buku</h3>
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
	<form action="update_pembelian.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_pasok" value="<?php echo $data['id_pasok'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="hidden" name="id_kasir" value="<?php echo $data['id_kasir'] ?>"></td>
			</tr>
<tr>
				<td>id Distributor</td>
				<td><input type="text" name="id_distributor" value="<?php echo $data['id_distributor'] ?>" class="form-control"></td>
			</tr>

			<tr>
				<td>Tanggal</td>
				<td><input name="tanggal" type="text" class="form-control" id="tgl" autocomplete="off" value="<?php echo $data['tanggal'] ?>"></td>
			</tr>
			<tr>
				<td>Judul Buku</td>
				<td><input type="text" name="judul" value="<?php echo $data['judul'] ?>" id="prd_name"  class="form-control"></td>
			</tr>		

			<tr>
				<td>id_buku</td>
				<td><input type="text" name="id_buku" value="<?php echo $data['id_buku'] ?>" id="prd_name"  class="form-control"></td>
			</tr>
			<tr>
				<td>NO ISBN</td>
				<td><input name="noisbn" type="text" class="form-control" placeholder="NO ISBN" autocomplete="off" id="prd_isbn" value="<?php echo $data['noisbn'] ?>"></td>
			</tr>
			<tr>
				<td>Harga Pokok</td>
				<td><input name="harga" type="text" class="form-control" placeholder="harga" autocomplete="off" id="prd_pok" onFocus="startCalc();" onBlur="stopCalc();" value="<?php echo $data['harga'] ?>"></td>
			</tr>
			
			<tr>
				<td>Jumlah</td>
				<td><input name="jumlah" type="text" class="form-control" placeholder="Jumlah" autocomplete="off" id="jml" onFocus="startCalc();" onBlur="stopCalc();" value="<?php echo $data['jumlah'] ?>"></td>
			</tr>
			<tr>
				<td>Total</td>
				<td><input name="total" type="text" class="form-control" placeholder="total" autocomplete="off" value="<?php echo $data['total'] ?>" id="total" onchange='tryNumberFormat(this.form.thirdBox);' readonly ></td>
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
			
		</table>
	</form>

<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
<script><!-- 

function startCalc(id){
interval = setInterval("calc()",1);}
function calc(){
one = document.getElementById('prd_pok').value;
two = document.getElementById('jml').value; 
document.getElementById('total').value = (one * 1) * (two * 1);}
function stopCalc(){
clearInterval(interval);}
</script>
<?php 
include 'footer.php';

?>