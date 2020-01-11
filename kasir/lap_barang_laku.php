<?php

include_once '../fungsi.php';
require('../assets/pdf/fpdf.php');
date_default_timezone_set('Asia/Jakarta');
$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->SetX(4);           
$pdf->MultiCell(21,0.5,'Book Store',0,'C');
$pdf->SetX(4);
$pdf->MultiCell(21,0.5,'Telpon : 08963738939',0,'C');    
$pdf->SetFont('Arial','B',13);
$pdf->SetX(4);
$pdf->MultiCell(21,0.5,'JL. Mangunreja Tasikmalaya',0,'C');
$pdf->SetX(4);
$pdf->MultiCell(21,0.5,'website : BookStore.com',0,'C');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0.7,'Laporan Data Penjualan Buku Berdasarkan Tanggal',0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->Cell(6,0.7,"Laporan Penjualan pada : ".$_GET['tanggal'],0,0,'C');
$pdf->ln(1);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Judul Buku', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'NO ISBN', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'harga', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Total harga', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'laba', 1, 1, 'C');

$no=1;
$tanggal=$_GET['tanggal'];
	$qu = "SELECT * from lap_penjualan where tanggal=" . $tanggal;
   $no=1;
    foreach ($con->query($qu) as $data) :
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $data['tanggal'],1, 0, 'C');
	$pdf->Cell(6, 0.8, $data['judul'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $data['noisbn'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $data['jumlah'], 1, 0,'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['harga_jual'])." ,-", 1, 0,'C');
	$pdf->Cell(3.5, 0.8, "Rp. ".number_format($data['total'])." ,-",1, 0, 'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['laba'])." ,-", 1, 1,'C');	
	
	$no++;
endforeach;
$prepare = $con->prepare("SELECT sum(total) as total from lap_penjualan where tanggal=".$tanggal);
            $prepare->execute();
			foreach ($prepare as $data) :
	$pdf->Cell(19, 0.8, "Total Pendapatan", 1, 0,'C');		
	$pdf->Cell(3.5, 0.8, "Rp. ".number_format($data['total'])." ,-", 1, 0,'C');	
endforeach;

$prepare = $con->prepare("SELECT sum(laba) as total_laba from lap_penjualan where tanggal=".$tanggal);
            $prepare->execute();
		
    foreach ($prepare as $data) :

	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['total_laba'])." ,-", 1, 1,'C');	
	endforeach;
$pdf->Output("laporan_buku.pdf","I");

?>

