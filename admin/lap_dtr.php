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
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Data Buku",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(10, 0.8, 'Nama', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Alamat', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Telepon', 1, 1, 'C');

$pdf->SetFont('Arial','',10);
$prepare = $con->prepare("SELECT * FROM distributor ORDER BY id_distributor");
            $prepare->execute();
   $no=1;
    foreach ($prepare as $data) :
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(10, 0.8, $data['nama_distributor'],1, 0, 'C');
	$pdf->Cell(7, 0.8, $data['alamat'], 1, 0,'C');
	$pdf->Cell(8, 0.8, $data['telepon'],1, 1, 'C');

	$no++;

endforeach;
	

$pdf->Output("laporan_distributor.pdf","I");

?>

