<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Pemasokan Buku</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
			<option>Pilih tanggal ..</option>
			<?php 
				$qu = "SELECT distinct tanggal FROM lap_pembelian order by tanggal desc";
    foreach ($con->query($qu) as $data) :
				?>
				<option><?php echo $data['tanggal'] ?></option>		
					 <?php
    endforeach;
    ?>	
		</select>
	</div>

</form>
<br/>
<?php 
if(isset($_GET['tanggal'])){
	$tanggal=$_GET['tanggal'];
	$tg="lap_pembelian_tanggal.php?tanggal='$tanggal'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_pembelian_tanggal.php";
}
?>

<br/>
<?php 
if(isset($_GET['tanggal'])){
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
}
?>
<form action="" method="get">
	<div class="input-group col-md-12  rizkyn">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari id Barang di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<table class="table">
	<tr>
		<th>No</th>
		<th>ID Pasok</th>
		<th>Tanggal</th>
		<th>Nama Distributor</th>
		<th>Judul</th>
		<th>NO ISBN</th>
		<th>Harga</th>
		<th>Jumlah</th>			
		<th>Total</th>			
		<th>Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['tanggal'])){
		$tanggal=$_GET['tanggal'];
		$prepare = $con->prepare("SELECT * FROM lap_pembelian WHERE tanggal LIKE '$tanggal' ORDER BY tanggal DESC");
            $prepare->execute();
	}elseif (isset($_GET['cari'])) {
		$cari=$_GET['cari'];
		$prepare = $con->prepare("SELECT * FROM lap_pembelian WHERE id_pasok LIKE '%$cari%'  ORDER BY id_pasok DESC");
            $prepare->execute();
	}else{
		$prepare = $con->prepare("SELECT * FROM lap_pembelian order by id_pasok desc");
            $prepare->execute();
	}
	$no=1;
	foreach ($prepare as $data) :

		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $data['id_pasok'] ?></td>
			<td><?php echo $data['tanggal'] ?></td>
			<td><?php echo $data['nama_distributor'] ?></td>
			<td><?php echo $data['judul'] ?></td>
			<td><?php echo $data['noisbn'] ?></td>
			<td><?php echo "Rp.".number_format($data['harga']).""?></td>
			<td><?php echo $data['jumlah'] ?></td>			
			<td><?php echo "Rp.".number_format($data['total']).""?></td>			
			<td>		
			<a href="det_pasok.php?id_pasok=<?php echo $data['id_pasok']; ?>" class="btn btn-info">Detail</a>
				<a href="edit_pasok.php?id_pasok=<?php echo $data['id_pasok']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_pembelian.php?id_pasok=<?php echo $data['id_pasok']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
	 <?php
		   $no++;
		   endforeach;
		       ?>	
	<tr>
		<td colspan="7">Total</td>
		<td></td>
		<?php 
		if(isset($_GET['tanggal'])){
			$tanggal=$_GET['tanggal'];	
			$prepare = $con->prepare("SELECT sum(total) as total from lap_pembelian where tanggal='$tanggal'");
            $prepare->execute();
            $data = $prepare->fetch(PDO::FETCH_ASSOC);
            echo "<td><b> Rp.". number_format($data['total']).",-</b></td>";
        }
        elseif(isset($_GET['cari'])){
			$cari=$_GET['cari'];	
			$prepare = $con->prepare("SELECT sum(total) as total from lap_pembelian where id_pasok='$cari'");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);	
	
			echo "<td><b> Rp.". number_format($data['total']).",-</b></td>";
		}else{
	
			$prepare = $con->prepare("SELECT sum(total) as total from lap_pembelian");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);	
	
			echo "<td><b> Rp.". number_format($data['total']).",-</b></td>";
		}

		?>
	</tr>
	
	
	<tr>
		<td colspan="7">Cetak Seluruh Penjualan</td>
		<td></td>
		<td><a style="margin-bottom:10px" href="lap_pembelian.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a></td>
	</tr>
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Pasokan Buku</h4>
				</div>
				<div class="modal-body">				
					<form action="pembelian_act.php" method="post">
					<div class="form-group">
							<input name="id_pasok" type="hidden" class="form-control" >
						</div>	
						<div class="form-group">
							<input name="id_kasir" type="hidden" class="form-control" value="<?php echo $_SESSION['id_kasir'] ?>">
						</div>	
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tanggal" type="text" class="form-control" id="tgl" autocomplete="off">
						</div>	
						<div class="form-group">							
							<?php  
  
$prepare = $con->prepare("SELECT * FROM distributor order by nama_distributor");
            $prepare->execute(); 
$jsArray1 = "var psk = new Array();\n";  
echo '<label>Nama Distributor</label> <select name="id_distributor" onchange="changeValue(this.value)" class="form-control">';  
echo '<option>-------</option>';  
	foreach ($prepare as $data) :
    echo '<option value="' . $data['id_distributor'] . '">' . $data['nama_distributor'] . '</option>';  
 endforeach;
echo '</select>';  
?>
						</div>

						<div class="form-group">							
							<?php  
  
$prepare = $con->prepare("SELECT * FROM buku order by judul");
            $prepare->execute(); 
$jsArray = "var prdName = new Array();\n";  
echo '<label>Judul Buku</label> <select name="buku" onchange="changeValue(this.value)" class="form-control">';  
echo '<option>-------</option>';  
	foreach ($prepare as $data) :
    echo '<option value="' . $data['judul'] . '">' . $data['judul'] . '</option>';  
    $jsArray .= "prdName['" . $data['judul'] . "'] = {name:'" . addslashes($data['id_buku']) . "',isbn:'" . addslashes($data['noisbn']) . "',harga_pok:'" . addslashes($data['harga_pokok']) . "'};\n";  
 endforeach;
echo '</select>';  
?>
						</div>									
						<div class="form-group">
							<input name="id_buku" type="hidden" class="form-control" id="prd_name">
						</div>	
						<div class="form-group">
							<label>NO ISBN</label>
							<input name="noisbn" type="text" class="form-control" placeholder="NO ISBN" autocomplete="off" id="prd_isbn">
						</div>
						<div class="form-group">
						<label>Harga </label>
							<input name="harga" type="text" class="form-control" placeholder="harga" autocomplete="off" id="prd_pok" onFocus="startCalc();" onBlur="stopCalc();" >
						</div>
						<div class="form-group">
							<label>Jumlah</label>
							<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" autocomplete="off" id="jml" onFocus="startCalc();" onBlur="stopCalc();" >
						</div>	
						<div class="form-group">
							<label>Total</label>
							<input name="total" type="text" class="form-control" placeholder="total" value="0" autocomplete="off" id="total" onchange='tryNumberFormat(this.form.thirdBox);' readonly >
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
<script type="text/javascript">
	<?php echo $jsArray1; ?>
function changeValue(id){
document.getElementById('psk_name').value = psk[id].name_psk;
};
</script>
	<script type="text/javascript">  

<?php echo $jsArray; ?>
function changeValue(id){
document.getElementById('prd_name').value = prdName[id].name;
document.getElementById('prd_isbn').value = prdName[id].isbn;
document.getElementById('prd_pok').value = prdName[id].harga_pok;
};

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

	<?php include 'footer.php'; ?>