<?php 
include_once 'fungsi.php';
session_start();
if (isset($_SESSION["username"])) {
    header("Location: acces.php");


}if (isset($_POST["kasir"])) {
	    $username = $_POST["username"];
    $password = $_POST["password"];
    $acces = $_POST["acces"];
 // lakukan select data admin ke database. untuk memastikan data ada di database


  $res = $con->query("SELECT * FROM kasir where username='$username' and password='$password' and acces='$acces'");
  $row = $res->fetch(PDO::FETCH_ASSOC);
   $username = $row['username'];
  $password = $row['password'];
   $acces = $row['acces'];
   $id_kasir = $row['id_kasir'];
   $nama = $row['nama'];
  if($username==$username && $password=$password && $acces==$acces && $id_kasir=$id_kasir && $nama=$nama)
 {
      // login berhasil

      // set session user, variabel yang dapat digunakan di semua halaman
      $_SESSION["username"] = $username;
      $_SESSION["acces"] = $acces;
      $_SESSION["id_kasir"] = $id_kasir;
      $_SESSION["nama"] = $nama;
     
      // redirect user ke halaman admin
      header("Location: acces.php");
      exit;
  
    } else {
      // login gagal
header("Location: index.php?pesan=gagal");
      exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>BookStore</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.js"></script>
	<style type="text/css">
	.kotak{	
		margin-top: 150px;
	}

	.kotak .input-group{
		margin-bottom: 20px;
	}
	</style>
</head>
<body>	
	<div class="container">
		<?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == "gagal"){
				echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Login Gagal !! Username dan Password Salah !!</div>";
			}
		}
		?>
		<div class="panel panel-default">
			<form action="" method="post">
				<div class="col-md-4 col-md-offset-4 kotak">
					<h3>Silahkan Login ..</h3>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"><select name="acces" class="form-control" required></span></span>
							<option value=''>-Pilih-</option>
							<option value='admin'>Admin</option>
							<option value='kasir'>Kasir</option>
					
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" placeholder="Username" name="username">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" class="form-control" placeholder="Password" name="password">
					</div>
					<div class="input-group">			
						<input type="submit" class="btn btn-primary" value="Login" name="kasir">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>