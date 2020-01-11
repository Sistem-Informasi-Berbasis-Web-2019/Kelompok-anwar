<?php

include_once '../fungsi.php';
require('../assets/pdf/fpdf.php');
date_default_timezone_set('Asia/Jakarta');
if(isset($_GET)){
		if(!empty($_GET["id_pasok"])){
			$id_pasok = $_GET["id_pasok"];
			$query = "SELECT * FROM lap_pembelian WHERE id_pasok = ?";

			$prepare = $con->prepare($query);
			$prepare->bindParam(1, $id_pasok);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
		} else {
			header("Location: pembelian.php");
		}
	} else {
		header("Location: pembelian.php");
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
$pdf->Cell(13.5,0.7,'ID Pasok : '.$data['id_pasok'],0,0,'R');
$pdf->Cell(13.5,0.7,'Kasir : '.$data['nama'],0,1,'L');
$pdf->Line(9.5,3.2,21,3.2,'C'); 
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(6.5,0.8,"Pemasokan Pada Tanggal : ".$data['tanggal'],0,0,'C');
$pdf->ln(1);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Distributor', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Judul Buku', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'NO ISBN', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Harga', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Total', 1, 1, 'C');

$no=1;

	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3.5, 0.8, $data['nama_distributor'],1, 0, 'C');
	$pdf->Cell(6, 0.8, $data['judul'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $data['noisbn'], 1, 0,'C');
	$pdf->Cell(4, 0.8, "Rp. ".number_format($data['harga'])."", 1, 0,'C');
	$pdf->Cell(4, 0.8, $data['jumlah'],1, 0, 'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['total'])." ", 1, 1,'C');	
	
	$no++;
	if(!empty($_GET["id_pasok"])){
			$id_pasok = $_GET["id_pasok"];
			$query = "SELECT sum(total) as total from lap_pembelian WHERE id_pasok= ?";

			$prepare = $con->prepare($query);
			$prepare->bindParam(1, $id_pasok);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
}
	$pdf->Cell(22.5, 0.8, "Total pengeluaran", 1, 0,'C');		
	$pdf->Cell(3, 0.8, "Rp. ".number_format($data['total'])." ", 1, 1,'C');	

$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->Output("laporan_buku.pdf","I");

?>

