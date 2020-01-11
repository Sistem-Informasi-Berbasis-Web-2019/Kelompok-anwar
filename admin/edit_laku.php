<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Data Penjualan</h3>
<a class="btn" href="barang_laku.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
if(isset($_GET)){
		if(!empty($_GET["id_penjualan"])){
			$id_penjualan = $_GET["id_penjualan"];
			$query = "SELECT * FROM lap_penjualan WHERE id_penjualan = ?";

			$prepare = $con->prepare($query);
			$prepare->bindParam(1, $id_penjualan);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
		} else {
			header("Location: barang.php");
		}
	} else {
		header("Location: barang.php");
	}

?>				
	<form action="update_laku.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_penjualan" value="<?php echo $data['id_penjualan'] ?>"></td>
			</tr>
<tr>
				<td>id Kasir</td>
				<td><input type="text" name="kasir" value="<?php echo $data['kasir'] ?>" class="form-control"></td>
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
				<td><input name="harga_pokok" type="text" class="form-control" placeholder="harga" autocomplete="off" id="prd_pok" onFocus="startCalc();" onBlur="stopCalc();" value="<?php echo $data['harga_pokok'] ?>"></td>
			</tr>
			<tr>
				<td>Harga Jual</td>
				<td><input name="harga_jual" type="text" class="form-control" placeholder="harga" autocomplete="off" id="prd_desc" onFocus="startCalc();" onBlur="stopCalc();" value="<?php echo $data['harga_jual'] ?>" ></td>
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
				<td>Bayar</td>
				<td><input name="bayar" type="text" class="form-control" placeholder="Bayar" autocomplete="off" id="bayar" onFocus="startCalc();" onBlur="stopCalc();" value="<?php echo $data['bayar'] ?>"></td>
			</tr>
			<tr>
				<td>Kembali</td>
				<td><input name="kembali" type="text" class="form-control" placeholder="kembali" autocomplete="off" value="<?php echo $data['bayar'] ?>" id="kembali" nchange='tryNumberFormat(this.form.thirdBox);' readonly></td>
			</tr>
			<tr>
				<td>Laba</td>
				<td><input name="laba" type="text" class="form-control" placeholder="NO ISBN" autocomplete="off" id="laba" value="<?php echo $data['laba'] ?>" nchange='tryNumberFormat(this.form.thirdBox);' readonly></td>
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
one = document.getElementById('prd_desc').value;
two = document.getElementById('jml').value; 
document.getElementById('total').value = (one * 1) * (two * 1);
ri = document.getElementById('total').value;
ky = document.getElementById('bayar').value; 
document.getElementById('kembali').value = (ky * 1) - (ri * 1);
ri = document.getElementById('prd_pok').value;
zky = document.getElementById('prd_desc').value; 
nur = document.getElementById('jml').value; 
document.getElementById('laba').value = ((zky * 1) - (ri * 1)) * (nur * 1);}
function stopCalc(){
clearInterval(interval);}
</script>
<?php 
include 'footer.php';

?>