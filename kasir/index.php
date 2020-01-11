<?php 
include_once '../fungsi.php';
include 'header.php';
?>

<?php
$a = $con->prepare("SELECT * FROM penjualan");
            $a->execute();
?>

<div class="col-md-10">
		<span style="display: inherit; background: #4689db; color: #fff; padding: 10px;">Dashboard</span>
		<div style="border-bottom:1px dashed #ccc;"></div><br>

<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<?php
						$prepare = $con->prepare("SELECT sum(total) as total1 from penjualan");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
			?>
						<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">Rp.<?php echo number_format($data['total1']) ?>,-</div>
							<div class="text-muted">Pendapatan</div>
						</div>
					</div>
				</div>
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<?php
						$prepare = $con->prepare("SELECT sum(total) as total2 from pasok");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
			?>
						<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">Rp.<?php echo number_format($data['total2']) ?>,-</div>
							<div class="text-muted">Pengeluaran</div>
						</div>
					</div>
				</div>
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<?php
						$prepare = $con->prepare("SELECT sum(laba) as total from penjualan");
            $prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
			?>
						<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">Rp.<?php echo number_format($data['total']) ?>,-</div>
							<div class="text-muted">Laba</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"/></svg>
						</div>
						<?php 
$artikel = $con->prepare("SELECT * FROM buku");
$artikel->execute();
$jumlahdata = $artikel->rowCount();
?>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $jumlahdata ?></div>
							<div class="text-muted">Buku</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
																	<?php 
$artikel = $con->prepare("SELECT * FROM penjualan");
$artikel->execute();
$jumlahdata = $artikel->rowCount();
?>
	
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $jumlahdata ?></div>
							<div class="text-muted">Transaksi</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
																							<?php 
$artikel = $con->prepare("SELECT * FROM distributor");
$artikel->execute();
$jumlahdata = $artikel->rowCount();
?>
	
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $jumlahdata ?></div>
							<div class="text-muted">Distributor</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';

?>