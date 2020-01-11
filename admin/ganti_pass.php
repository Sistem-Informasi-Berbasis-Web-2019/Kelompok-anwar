<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Password</h3>
<br/><br/>
<?php 
if(isset($_GET['pesan'])){
	$pesan=$_GET['pesan'];
	if($pesan=="gagal"){
		echo "<div class='alert alert-danger'>Password gagal di ganti !!     Periksa Kembali Password yang anda masukkan !!</div>";
	}else if($pesan=="tdksama"){
		echo "<div class='alert alert-warning'>Password yang anda masukkan tidak sesuai  !!     silahkan ulangi !! </div>";
	}else if($pesan=="oke"){
		echo "<div class='alert alert-success'>Password yang anda masukkan tidak sesuai  !!     silahkan ulangi !! </div>";
	}
}
?>
	<script>
	function ShowPassword()
	{
		if(document.getElementById("mypass").value!="")
		{
			document.getElementById("mypass").type="text";
			document.getElementById("show").style.display="none";
			document.getElementById("hide").style.display="block";
		}
			if(document.getElementById("mypass1").value!="")
		{
			document.getElementById("mypass1").type="text";
			document.getElementById("show").style.display="none";
			document.getElementById("hide").style.display="block";
		}
				if(document.getElementById("mypass2").value!="")
		{
			document.getElementById("mypass2").type="text";
			document.getElementById("show").style.display="none";
			document.getElementById("hide").style.display="block";
		}
	}

	function HidePassword()
	{
		if(document.getElementById("mypass").type == "text")
		{
			document.getElementById("mypass").type="password"
			document.getElementById("show").style.display="block";
			document.getElementById("hide").style.display="none";
		}
		if(document.getElementById("mypass1").type == "text")
		{
			document.getElementById("mypass1").type="password"
			document.getElementById("show").style.display="block";
			document.getElementById("hide").style.display="none";
		}
		if(document.getElementById("mypass2").type == "text")
		{
			document.getElementById("mypass2").type="password"
			document.getElementById("show").style.display="block";
			document.getElementById("hide").style.display="none";
		}
	}
	</script>
<br/>
<div class="col-md-5 col-md-offset-3">
	<form action="ganti_pass_act.php" method="post">
		<div class="form-group">
			<input name="user" type="hidden" value="<?php echo $_SESSION['username']; ?>">
		</div>
		<div class="form-group">
			<label>Password Lama</label>
			<input name="lama" type="password" id="mypass" class="form-control" placeholder="Password Lama ..">
		</div>
		<div class="form-group">
			<label>Password Baru</label>
			<input name="baru" type="password" id="mypass1" class="form-control" placeholder="Password Baru ..">
		</div>
		<div class="form-group">
			<label>Ulangi Password</label>
			<input name="ulang" type="password" id="mypass2" class="form-control" placeholder="Ulangi Password ..">
		</div>	
		<div class="form-group">
			<label></label>
			<input type="submit" class="btn btn-info" value="Simpan">
			<input type="reset" class="btn btn-danger" value="reset">
		</div>					
		<div class="form-group">
			<input type=button id="show" class="btn btn-danger" value="perlihatkan Password" onclick="ShowPassword()">
	       <input type=button style="display:none" class="btn btn-info" id="hide" value="Hilangkan Password" onclick="HidePassword()">
		</div>													
	</form>
</div>


<?php 
include 'footer.php';

?>