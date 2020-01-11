<?php include 'header.php';	?>
<table class="table">
<tr>
<td><button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Entry</button></td>
</tr>
	<form action="barang_laku_act.php" method="post">	
<tr>
<td colspan="7"><h3><span class="glyphicon glyphicon-briefcase"></span>  Transakasi Penjualan</h3></td>
<td></td>
<td>
		<?php
		date_default_timezone_set('Asia/Jakarta');
		$tgl=date('Y-m-d');

						$prepare = $con->prepare("SELECT * from penjualan order by id_penjualan desc limit 1");
            $prepare->execute();
           $data = $prepare->fetch(PDO::FETCH_ASSOC);
                        $angka=$data['id_penjualan']+1;
  ?>
<div class="form-group">
						<label>NO Transakasi.</label>
							<input name="id_penjualan" type="text" class="form-control" value="<?php echo $angka?>" readonly>
						</div>
					
						
</td>
<td><label>Tanggal Transaksi.</label>
<input name="tanggal" value="<?php echo $tgl ?>" type="text" class="form-control" readonly></td>
</tr>
</table>

	<br/>

<table class="table">
	<tr>
		<th>No</th>
		<th>ID Penjulan</th>
		<th>ID Buku</th>
		<th>Judul Buku</th>
		<th>Harga</th>
		<th>Jumlah</th>
		<th>Total</th>			
		<th class="col-md-3">Opsi</th>			
		
	</tr>
	<?php 
	
		$prepare = $con->prepare("SELECT * FROM tbl_sementara_penjualan");
            $prepare->execute();
	$no=1;
	foreach ($prepare as $data) :

		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $data['id_penjualan'] ?></td>
			<td><?php echo $data['id_buku'] ?></td>
			<td><?php echo $data['judul'] ?></td>
			<td><?php echo "Rp.".number_format($data['harga']).""?></td>
			<td><?php echo $data['jumlah'] ?></td>			
			<td><?php echo "Rp.".number_format($data['total']).""?></td>
				<td><a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_tbl_sementara.php?id_buku=<?php echo $data['id_buku']; ?>' }" class="btn btn-danger">Hapus</a></td>
		
			
		</tr>
	 <?php
		   $no++;
		   endforeach;
		       ?>	
	<tr>
		<td colspan="7">Total</td>
		<?php 
	
			$prepare = $con->prepare("SELECT sum(total) as total from tbl_sementara_penjualan");
            $prepare->execute();
            $data = $prepare->fetch(PDO::FETCH_ASSOC);
            ?>
            <td><input name="total" type="text" class="form-control" value="<?php echo $data['total']?>"  id="tt" onFocus="startCalc();" onBlur="stopCalc();"  readonly></td>
        
		
		
	</tr>
	<tr>
		<td colspan="7">bayar</td>
		 <td><input name="bayar" type="text" class="form-control" id="bayar" onFocus="startCalc();" onBlur="stopCalc();" value="0"></td>
	</tr>
	<tr>
		<td colspan="7">kembali</td>
		 <td><input name="kembali" type="text" class="form-control"  id="kembali" value="0" nchange='tryNumberFormat(this.form.thirdBox);' readonly></td>
	</tr>
			<td colspan="7">
			<?php
$prepare = $con->prepare("SELECT sum(jumlah) as jumlah from tbl_sementara_penjualan");
            $prepare->execute();
            $data = $prepare->fetch(PDO::FETCH_ASSOC);
            ?>
			<input name="jumlah" type="hidden" class="form-control" value="<?php echo $data['jumlah']?>"></td>
		<?php 
	
			$prepare = $con->prepare("SELECT sum(laba) as laba from tbl_sementara_penjualan");
            $prepare->execute();
            $data = $prepare->fetch(PDO::FETCH_ASSOC);
            ?>
            <td><input name="laba" type="hidden" class="form-control" value="<?php echo $data['laba']?>"  id="tt" onFocus="startCalc();" onBlur="stopCalc();"></td>
        
						<tr><td><div class="form-group">
							<input name="id_kasir" type="hidden" class="form-control" value="<?php echo $_SESSION['id_kasir']  ?>">
						</div>	
						<div class="modal-footer">
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan" name="proses">
					</div></td>
		</form>
		
	</tr>
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Penjualan Buku</h4>
				</div>
				<div class="modal-body">				
					<form action="barang_laku_act.php" method="post">	

					<?php
	
						$prepare = $con->prepare("SELECT * from penjualan order by id_penjualan desc limit 1");
            $prepare->execute();
           $data = $prepare->fetch(PDO::FETCH_ASSOC);
                        $angka=$data['id_penjualan']+1;
?>

						<div class="form-group">
						<label>No Transakasi</label>
							<input name="id_penjualan" type="text" class="form-control" value="<?php echo $angka?>" readonly>
						</div>
		
						<div class="form-group">
							<input name="id_kasir" type="hidden" class="form-control" value="<?php echo $_SESSION['id_kasir']  ?>">
						</div>	
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tanggal" type="text" class="form-control" id="tgl" autocomplete="off">
						</div>	
						<div class="form-group">							
							<?php  
  
$prepare = $con->prepare("SELECT * FROM buku order by judul");
            $prepare->execute(); 
$jsArray = "var prdName = new Array();\n";  
echo '<label>Judul Buku</label> <select name="judul" onchange="changeValue(this.value)" class="form-control">';  
echo '<option>-------</option>';  
	foreach ($prepare as $data) :
    echo '<option value="' . $data['judul'] . '">' . $data['judul'] . '</option>';  
    $jsArray .= "prdName['" . $data['judul'] . "'] = {name:'" . addslashes($data['id_buku']) . "',harga_pok:'" . addslashes($data['harga_pokok']) . "',stoke:'" . addslashes($data['stok']) . "',desc:'".addslashes($data['harga_jual'])."'};\n";  
 endforeach;
echo '</select>';  
?>
						</div>									
						<div class="form-group">
							<input name="id_buku" type="hidden" class="form-control" id="prd_name">
						</div>	
						<div class="form-group">
							<input name="harga" type="hidden" class="form-control" placeholder="harga" autocomplete="off" id="prd_pok" onFocus="startCalc();" onBlur="stopCalc();" >
						</div>
						<div class="form-group">
							<label>Stok Buku</label>
							<input name="stok" type="text" class="form-control" placeholder="Stok" autocomplete="off" id="prd_st"  disabled>
						</div>
						<div class="form-group">
							<label>Harga Jual / unit</label>
							<input name="harga_jual" type="text" class="form-control" placeholder="harga" autocomplete="off" id="prd_desc" onFocus="startCalc();" onBlur="stopCalc();" disabled>
						</div>
						<div class="form-group">
							<label>Jumlah</label>
							<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" autocomplete="off" id="jml" onFocus="startCalc();" onBlur="stopCalc();" >
						</div>	
						<div class="form-group">
							<label>Total</label>
							<input name="total" type="text" class="form-control" placeholder="total" value="0" autocomplete="off" id="total" onchange='tryNumberFormat(this.form.thirdBox);' readonly >
						<div class="form-group">
							<input name="laba" type="hidden" class="form-control" placeholder="NO ISBN" autocomplete="off" id="laba" value="0" nchange='tryNumberFormat(this.form.thirdBox);' readonly>
						</div>
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
<?php echo $jsArray; ?>
function changeValue(id){
document.getElementById('prd_name').value = prdName[id].name;
document.getElementById('prd_st').value = prdName[id].stoke;
document.getElementById('prd_pok').value = prdName[id].harga_pok;
document.getElementById('prd_desc').value = prdName[id].desc;
};
</script>
<script><!-- 

function startCalc(id){
interval = setInterval("calc()",1);}
function calc(){
one = document.getElementById('prd_desc').value;
two = document.getElementById('jml').value; 
document.getElementById('total').value = (one * 1) * (two * 1);
ri = document.getElementById('tt').value;
ky = document.getElementById('bayar').value; 
document.getElementById('kembali').value = (ky * 1) - (ri * 1);
ri = document.getElementById('prd_pok').value;
zky = document.getElementById('prd_desc').value; 
nur = document.getElementById('jml').value; 
document.getElementById('laba').value = ((zky * 1) - (ri * 1)) * (nur * 1);}
function stopCalc(){
clearInterval(interval);}
</script>
	<?php include 'footer.php'; ?>