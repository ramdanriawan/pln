<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../logo/logo_pln.jpg',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'PT PLN (PERSERO)',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'WILAYAH KALSEL & KALTENG',0,'L'); 
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'AREA PENYALURAN & PENGATUR BEBAN SISTEM KALSEL & KALTENG',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Jl. Mistar Cokrokusumo Km. 39 Komplek Gardu Induk Cempaka Banjarbaru 70733',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Data Kendaraan",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Nomor Polisi', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Merk', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Warna', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Peruntukkan', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Lokasi', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Harga Sewa', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysql_query("select * from tb_kendaraan");
while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['no_pol'],1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['merk'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['warna'],1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['peruntukkan'], 1, 0,'C');
	$pdf->Cell(5, 0.8, $lihat['lokasi'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['hrg_sewa'], 1, 1,'C');

	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

