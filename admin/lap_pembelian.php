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
$pdf->Cell(25.5,0.7,"Laporan Data Pemasokan Buku",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Distributor', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Judul Buku', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'No ISBN', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'harga', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Total', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$qu = "SELECT * FROM lap_pembelian ";
   $no=1;
    foreach ($con->query($qu) as $data) :
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(5, 0.8, $data['nama_distributor'],1, 0, 'C');
	$pdf->Cell(8, 0.8, $data['judul'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $data['noisbn'],1, 0, 'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['harga'])."", 1, 0,'C');
	$pdf->Cell(2, 0.8, $data['jumlah'],1, 0, 'C');
	$pdf->Cell(3, 0.8,  "Rp. ".number_format($data['total'])."", 1, 1,'C');
	$no++;

endforeach;
	$prepare = $con->prepare("SELECT sum(total) as total from lap_pembelian ");
            $prepare->execute();
			foreach ($prepare as $data) :
	$pdf->Cell(23, 0.8, "Total pengeluaran", 1, 0,'C');		
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['total'])." ", 1, 1,'C');	
endforeach;

$pdf->Output("laporan_buku.pdf","I");

?>

