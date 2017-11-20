<?php
/*
 * file ini berfungsi untuk menghasilkan output file pdf
 * yang siap cetak, dengan ukuran kertas A5 atau separuh dari kuarto
 * silakan rubah ukuran masing-masing variabel untuk menentukan panjang dan lebar kertas
 * 
 * variabel $line_h berfungsi untuk mengatur tinggi tiap-tiap baris
 * variabel $font berfungsi untuk mengatur tampilan font pada file pdf defaultnya adalah Arial
 * 
 */

include 'config.php';
require('../assets/pdf/fpdf.php');
require_once("pengaturan.php");
$no_permohonan=mysql_real_escape_string($_GET['no_permohonan']);

$pengaturan=new Pengaturan();
$pdf=new FPDF('L','mm','A5');/*L untuk tampilan Landscape, A5 adalah ukuran kertasnya*/
/*
 * Pengaturan Nama Bulan sesuai bahasa Indonesia
 */
$arraybln=array('January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
$bln=$arraybln[date('n')-1];
$thn=date('Y');
$tgl=date('d');
/*membuat file PDF untuk dicetak*/
$pdf->setMargins(10,3,10,3);
$pdf->SetAutoPageBreak(True, 3);
$pdf->AddPage();
$pdf->SetLineWidth(0.8);
$pdf->Line(5,3,205,3);
$pdf->Line(205,3,205,145);
$pdf->Line(5,3,5,145);
$pdf->Line(5,145,205,145);
$pdf->SetFont('Arial','B',10);
$pdf->Image('../logo/logo2.png',175,5,25,12);
$pdf->Cell(0,10,$pengaturan->atur['namapt'],0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,0,$pengaturan->atur['alamat']);
$pdf->SetLineWidth(0.8);
$pdf->Ln(12);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(60,5,'',0,0,'');
$pdf->Cell(80,0.7,"PERMOHONAN PINJAM KENDARAAN DINAS",0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(200,10,"No.Dokumen : AP2B/FM/05-21",0,1,'C');
$pdf->Cell(200,0,"UNTUK KEPERLUAN DINAS/SOSIAL",0,1,'C');
$pdf->SetLineWidth(0.4);
$pdf->SetFont('Arial','',11);
$pdf->Ln(10);
$query=mysql_query("SELECT nama, bagian, jumlah_penumpang, hari_tgl,hari_tglakhir, jam_awal, jam_akhir, tujuan, keperluan								
								FROM tb_permohonan where no_permohonan=$no_permohonan");
while($b=mysql_fetch_array($query)){
$pdf->Cell(36,0,'Nama ',0,0,'L');
$pdf->Cell(5,0,':',0,0,'L');
$pdf->Cell(0,0,strtoupper($b['nama']),0,1,'L');
$pdf->Cell(36,10,'Bagian',0,0,'L');
$pdf->Cell(5,10,':',0,0,'L');
$pdf->Cell(0,10,strtoupper($b['bagian']),0,1,'L');
$pdf->Cell(36,0,'Jumlah Penumpang',0,0,'L');
$pdf->Cell(5,0,':',0,0,'L');
$pdf->Cell(0,0,strtoupper($b['jumlah_penumpang']).' '.'ORANG',0,1,'L');
$pdf->Cell(36,10,'Hari, Tanggal',0,0,'L');
$pdf->Cell(5,10,':',0,0,'L');
$pdf->Cell(58,10,strtoupper($b['hari_tgl']),0,0,'L');
$pdf->Cell(10,10,'s.d',0,0,'L');
$pdf->Cell(0,10,strtoupper($b['hari_tglakhir']),0,1,'L');
$pdf->Cell(36,0,'Jam ',0,0,'L');
$pdf->Cell(5,0,':',0,0,'L');
$pdf->Cell(20,0,strtoupper($b['jam_awal']),0,0,'L');
$pdf->Cell(10,0,'s.d',0,0,'L');
$pdf->Cell(0,0,strtoupper($b['jam_akhir']),0,1,'L');
$pdf->Cell(36,10,'Tujuan',0,0,'L');
$pdf->Cell(5,10,':',0,0,'L');
$pdf->Cell(0,10,strtoupper($b['tujuan']),0,1,'L');
$pdf->Cell(36,0,'Keperluan ',0,0,'L');
$pdf->Cell(5,0,':',0,0,'L');
$pdf->Cell(0,0,strtoupper($b['keperluan']),0,1,'L');
$pdf->Ln(8);
$pdf->Cell(116,5,'',0,0,'');
$pdf->SetFont('Arial','',11);
$pdf->Cell(90,5,$pengaturan->atur['kota'].', '.$tgl.' '.$bln.' '.$thn,0,1,'C');
$pdf->Ln(3);
$pdf->Cell(75,0,'Menyetujui',0,0,'C');
$pdf->Cell(45,0,'Mengetahui',0,0,'C');
$pdf->Cell(75,0,'Pemohon',0,1,'C');
$pdf->Ln(30);
$pdf->Cell(75,0,'.............................',0,0,'C');
$pdf->Cell(45,0,'.............................',0,0,'C');
$pdf->Cell(75,0,'.............................',0,1,'C');

$pdf->SetFont('Arial','U',9);
$pdf->Ln(8);
$pdf->Cell(36,0,'Catatan Pool :',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(36,10,'Plat No. : ..............................',0,1,'L');
$pdf->Cell(36,0,'Driver    : ..............................',0,1,'L');
}

$tglcetak_permohonan=date('Y-m-d');
mysql_query("update tb_permohonan set tglcetak_permohonan='$tglcetak_permohonan' where no_permohonan='$no_permohonan'");
$pdf->Output();
?>
