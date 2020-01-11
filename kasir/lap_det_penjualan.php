<?php

include_once '../fungsi.php';
require('../assets/pdf/fpdf.php');
date_default_timezone_set('Asia/Jakarta');
if(isset($_GET['id_penjualan'])){
		$id_penjualan=$_GET['id_penjualan'];
		$prepare = $con->prepare("SELECT * FROM lap_penjualan WHERE id_penjualan");
            $prepare->execute();
             $data = $prepare->fetch(PDO::FETCH_ASSOC);
         }
$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->SetX(4);           
$pdf->MultiCell(22.5,0.5,'Book Store',0,'C');
$pdf->SetX(4);
$pdf->MultiCell(22.5,0.5,'Telpon : 08963738939',0,'C');    
$pdf->SetFont('Arial','B',13);
$pdf->SetX(4);
$pdf->MultiCell(22.5,0.5,'JL. Mangunreja Tasikmalaya',0,'C');
$pdf->SetX(4);
$pdf->MultiCell(22.5,0.5,'website : BookStore.com',0,'C');
$pdf->Line(9.5,3.1,21,3.1,'C');
$pdf->SetLineWidth(0.1);      
$pdf->Line(9.5,3.2,21,3.2,'C');   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(13.5,0.7,'ID Pasok : '.$data['id_penjualan'],0,0,'R');
$pdf->Cell(13.5,0.7,'Kasir : '.$data['nama'],0,1,'L');
$pdf->Line(9.5,3.2,21,3.2,'C'); 
$pdf->ln(1);
if(isset($_GET['id_penjualan'])){
		$id_penjualan=$_GET['id_penjualan'];
		$prepare = $con->prepare("SELECT * FROM detail_penjualan WHERE id_penjualan");
            $prepare->execute();
         }

foreach ($prepare as $data) :
	$pdf->Cell(10, 0.8, $data['judul'],0, 0, 'R');
	$pdf->Cell(2, 0.8, $data['jumlah'],0, 0, 'C');
	$pdf->Cell(4, 0.8, "Rp. ".number_format($data['harga'])."", 0, 0,'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['total'])." ", 0, 1,'C');	
	
	endforeach;
	$pdf->Line(9.5,3.1,21,3.1,'C');
$pdf->SetLineWidth(0.1);      
$pdf->Line(9.5,3.2,21,3.2,'C');   
$pdf->SetLineWidth(0);
$pdf->ln(1);
if(isset($_GET['id_penjualan'])){
		$id_penjualan=$_GET['id_penjualan'];
		$prepare = $con->prepare("SELECT * FROM penjualan WHERE id_penjualan");
            $prepare->execute();
         }

foreach ($prepare as $data) :
	$pdf->Cell(10, 0.8, 'Total Item',0, 0, 'R');
$pdf->Cell(2, 0.8, $data['jumlah'],0, 0, 'C');
	$pdf->Cell(4, 0.8,  $data['k'], 0, 0,'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['total'])." ", 0, 1,'C');	
	
	endforeach;	
	if(isset($_GET['id_penjualan'])){
		$id_penjualan=$_GET['id_penjualan'];
		$prepare = $con->prepare("SELECT * FROM penjualan WHERE id_penjualan");
            $prepare->execute();
         }

foreach ($prepare as $data) :
	$pdf->Cell(10, 0.8, 'Total Belanja',0, 0, 'R');
	$pdf->Cell(4, 0.8,  $data['k'], 0, 0,'C');
	$pdf->Cell(2, 0.8, $data['k'],0, 0, 'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['total'])." ", 0, 1,'C');	
	
	endforeach;
		if(isset($_GET['id_penjualan'])){
		$id_penjualan=$_GET['id_penjualan'];
		$prepare = $con->prepare("SELECT * FROM penjualan WHERE id_penjualan");
            $prepare->execute();
         }

foreach ($prepare as $data) :
	$pdf->Cell(10, 0.8, 'Tunai',0, 0, 'R');
	$pdf->Cell(4, 0.8,  $data['k'], 0, 0,'C');
	$pdf->Cell(2, 0.8, $data['k'],0, 0, 'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['bayar'])." ", 0, 1,'C');	
	
	endforeach;	
		if(isset($_GET['id_penjualan'])){
		$id_penjualan=$_GET['id_penjualan'];
		$prepare = $con->prepare("SELECT * FROM penjualan WHERE id_penjualan");
            $prepare->execute();
         }

foreach ($prepare as $data) :
	$pdf->Cell(10, 0.8, 'Kembalian',0, 0, 'R');
	$pdf->Cell(4, 0.8,  $data['k'], 0, 0,'C');
	$pdf->Cell(2, 0.8, $data['k'],0, 0, 'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['kembalian'])." ", 0, 1,'C');	
	
	endforeach;
	$pdf->Line(9.5,3.1,21,3.1,'C');
$pdf->SetLineWidth(0.1);      
$pdf->Line(9.5,3.2,21,3.2,'C');   
$pdf->SetLineWidth(0);
$pdf->ln(1);

		if(isset($_GET['id_penjualan'])){
		$id_penjualan=$_GET['id_penjualan'];
		$prepare = $con->prepare("SELECT * FROM penjualan WHERE id_penjualan");
            $prepare->execute();
         }

foreach ($prepare as $data) :
	$pdf->Cell(10, 0.8, 'Tanggal',0, 0, 'R');
	$pdf->Cell(4, 0.8,  'Transaksi:', 0, 0,'C');
	$pdf->Cell(2, 0.8, $data['k'],0, 0, 'C');
	$pdf->Cell(3, 0.8, $data['tanggal'], 0, 1,'C');	
	
	endforeach;
		$pdf->Line(9.5,3.1,21,3.1,'C');
$pdf->SetLineWidth(0.1);      
$pdf->Line(9.5,3.2,21,3.2,'C');   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->Cell(26, 0.8, "Kritik dan Saran Hubungi BookStrore contact", 0, 1,'C');
$pdf->Cell(26, 0.8, "Telp : 021-829297  Sms : 085328262828", 0, 1,'C');	
$pdf->Cell(26, 0.8, "BookStore.com", 0, 1,'C');	

$pdf->Output("laporan_buku.pdf","I");

?>

