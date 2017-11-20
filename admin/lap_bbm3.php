<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,0.5,0.5);
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
$pdf->Cell(25.5,0.7,"Rekap Data Kendaraan Keseluruhan",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Rekap Bulan: ".$_GET['tanggal'],0,0,'C');
$data=$_GET['tanggal'];
$pdf->Cell(5,0.7,"Dicetak pada : ".date("d-m-Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'No. Polisi', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Merk', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tipe', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Awal', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Akhir', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Total KM', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Vol. BBM', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Biaya BBM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Volume/KM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM/Hari', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Harga/Liter', 1, 1, 'C');
$no=1;
$totalvolumekm=0;
$totalkmhari=0;
$totalhargarata=0;

$query=mysql_query("SELECT tb_bbm.no_kendaraan, 
				  SUM(tb_bbm.volume) as jumlahvolume,
								MIN(tb_bbm.stand_km) as kmawal,
								MAX(tb_bbm.stand_km) as kmakhir,
								SUM(tb_bbm.total) as biayabbm,
								tb_kendaraan.merk, tb_kendaraan.tipe

								FROM tb_bbm,tb_kendaraan where date_format(tgl_transaksi,'%m-%Y') = $data  and tb_bbm.no_kendaraan=tb_kendaraan.no_pol
								GROUP BY no_kendaraan");
while($b=mysql_fetch_array($query)){
	$awal=$b['kmawal'];
	$akhir=$b['kmakhir'];
	$awalakhir=$akhir-$awal;
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['no_kendaraan'],1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['merk'], 1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['tipe'], 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['kmawal'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $b['kmakhir'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $awalakhir."KM",1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $b['jumlahvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($b['biayabbm'])." ,-",1, 0, 'C');
	$no++;
	
	

	$volume=$b['jumlahvolume'];
	$volkm=$volume/$awalakhir;
	$pdf->Cell(2, 0.8, number_format($volkm,2)."L", 1, 0,'C');
	$bulan=substr($data,1,2);
	$tahun=substr($data,4,4);
	$hari=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
	$kmhari=$awalakhir/$hari;
	$pdf->Cell(2, 0.8, number_format($kmhari,2)."KM", 1,0,'C');	
	$biayabbm=$b['biayabbm'];
	$hargarata=$biayabbm/$volume;
	$pdf->Cell(2, 0.8,"Rp. ".number_format($hargarata)." ,-",1, 1, 'C');
	$totalvolumekm=$totalvolumekm+$volkm;
	$totalkmhari=$totalkmhari+$kmhari;
	$totalhargarata=$totalhargarata+$hargarata;
}

$q=mysql_query("SELECT SUM(volume) as totalvolume,
					SUM(total) as totalbiaya,
					MIN(stand_km) as totalkmawal,
					MAX(stand_km) as totalkmakhir
					FROM tb_bbm where date_format(tgl_transaksi,'%m-%Y') = $data");
while($c=mysql_fetch_array($q)){
	$pdf->Cell(15, 0.8, "Total", 1, 0,'C');		
	$pdf->Cell(2.5, 0.8, $c['totalvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($c['totalbiaya'])." ,-", 1, 0,'C');		
	$pdf->Cell(2, 0.8, number_format($totalvolumekm,2)."L", 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format($totalkmhari,2)."KM", 1, 0,'C');
	$pdf->Cell(2, 0.8,"Rp. ".number_format($totalhargarata)." ,-",1, 1, 'C');
}



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
$pdf->Cell(25.5,0.7,"Rekap Data Kendaraan AP2B",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Rekap Bulan: ".$_GET['tanggal'],0,0,'C');
$data=$_GET['tanggal'];
$pdf->Cell(5,0.7,"Dicetak pada : ".date("d-m-Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'No. Polisi', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Merk', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tipe', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Awal', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Akhir', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Total KM', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Vol. BBM', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Biaya BBM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Volume/KM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM/Hari', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Harga Rata-rata', 1, 1, 'C');
$no=1;
$totalvolumekm4=0;
$totalkmhari4=0;
$totalhargarata4=0;
$query=mysql_query("SELECT tb_bbm.no_kendaraan, 
				  SUM(tb_bbm.volume) as jumlahvolume,
								MIN(tb_bbm.stand_km) as kmawal,
								MAX(tb_bbm.stand_km) as kmakhir,
								SUM(tb_bbm.total) as biayabbm,
								tb_kendaraan.lokasi, tb_kendaraan.merk, tb_kendaraan.tipe
								
								FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_kendaraan.lokasi='AP2B' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan
								GROUP BY tb_bbm.no_kendaraan");
while($b=mysql_fetch_array($query)){
	$awal=$b['kmawal'];
	$akhir=$b['kmakhir'];
	$awalakhir=$akhir-$awal;
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['no_kendaraan'],1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['merk'], 1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['tipe'], 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['kmawal'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $b['kmakhir'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $awalakhir."KM",1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $b['jumlahvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($b['biayabbm'])." ,-",1, 0, 'C');
	$no++;
	
	

	$volume=$b['jumlahvolume'];
	$volkm=$volume/$awalakhir;
	$pdf->Cell(2, 0.8, number_format($volkm,2)."L", 1, 0,'C');
	$bulan=substr($data,1,2);
	$tahun=substr($data,4,4);
	$hari=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
	$kmhari=$awalakhir/$hari;
	$pdf->Cell(2, 0.8, number_format($kmhari,2)."KM", 1,0,'C');	
	$biayabbm=$b['biayabbm'];
	$hargarata=$biayabbm/$volume;
	$pdf->Cell(2, 0.8,"Rp. ".number_format($hargarata)." ,-",1, 1, 'C');
	$totalvolumekm4=$totalvolumekm4+$volkm;
	$totalkmhari4=$totalkmhari4+$kmhari;
	$totalhargarata4=$totalhargarata4+$hargarata;
}

$q=mysql_query("SELECT SUM(tb_bbm.volume) as totalvolume,
					SUM(tb_bbm.total) as totalbiaya,
					MIN(tb_bbm.stand_km) as totalkmawal,
					MAX(tb_bbm.stand_km) as totalkmakhir,
					tb_kendaraan.lokasi
					FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_bbm.no_kendaraan=tb_kendaraan.no_pol and tb_kendaraan.lokasi='AP2B' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan");
while($c=mysql_fetch_array($q)){
	$pdf->Cell(15, 0.8, "Total", 1, 0,'C');		
	$pdf->Cell(2.5, 0.8, $c['totalvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($c['totalbiaya'])." ,-", 1, 0,'C');		
	$pdf->Cell(2, 0.8, number_format($totalvolumekm4,2)."L", 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format($totalkmhari4,2)."KM", 1, 0,'C');
	$pdf->Cell(2, 0.8,"Rp. ".number_format($totalhargarata4)." ,-", 1, 1,'C');		
}



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
$pdf->Cell(25.5,0.7,"Rekap Data Kendaraan Tragi Banjar",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Rekap Bulan: ".$_GET['tanggal'],0,0,'C');
$data=$_GET['tanggal'];
$pdf->Cell(5,0.7,"Dicetak pada : ".date("d-m-Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'No. Polisi', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Merk', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tipe', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Awal', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Akhir', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Total KM', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Vol. BBM', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Biaya BBM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Volume/KM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM/Hari', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Harga Rata-rata', 1, 1, 'C');
$no=1;
$totalvolumekm2=0;
$totalkmhari2=0;
$totalhargarata2=0;
$query=mysql_query("SELECT tb_bbm.no_kendaraan, 
				  SUM(tb_bbm.volume) as jumlahvolume,
								MIN(tb_bbm.stand_km) as kmawal,
								MAX(tb_bbm.stand_km) as kmakhir,
								SUM(tb_bbm.total) as biayabbm,
								tb_kendaraan.lokasi,tb_kendaraan.merk,tb_kendaraan.tipe
								
								FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_kendaraan.lokasi='TRAGI BANJAR' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan
								GROUP BY tb_bbm.no_kendaraan");
while($b=mysql_fetch_array($query)){
	$awal=$b['kmawal'];
	$akhir=$b['kmakhir'];
	$awalakhir=$akhir-$awal;
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['no_kendaraan'],1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['merk'], 1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['tipe'], 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['kmawal'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $b['kmakhir'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $awalakhir."KM",1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $b['jumlahvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($b['biayabbm'])." ,-",1, 0, 'C');
	$no++;
	
	

	$volume=$b['jumlahvolume'];
	$volkm=$volume/$awalakhir;
	$pdf->Cell(2, 0.8, number_format($volkm,2)."L", 1, 0,'C');
	$bulan=substr($data,1,2);
	$tahun=substr($data,4,4);
	$hari=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
	$kmhari=$awalakhir/$hari;
	$pdf->Cell(2, 0.8, number_format($kmhari,2)."KM", 1,0,'C');	
	$biayabbm=$b['biayabbm'];
	$hargarata=$biayabbm/$volume;
	$pdf->Cell(2, 0.8,"Rp. ".number_format($hargarata)." ,-",1, 1, 'C');
	$totalvolumekm2=$totalvolumekm2+$volkm;
	$totalkmhari2=$totalkmhari2+$kmhari;
	$totalhargarata2=$totalhargarata2+$hargarata;
}

$q=mysql_query("SELECT SUM(tb_bbm.volume) as totalvolume,
					SUM(tb_bbm.total) as totalbiaya,
					MIN(tb_bbm.stand_km) as totalkmawal,
					MAX(tb_bbm.stand_km) as totalkmakhir,
					tb_kendaraan.lokasi
					FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_bbm.no_kendaraan=tb_kendaraan.no_pol and tb_kendaraan.lokasi='TRAGI BANJAR' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan");
while($c=mysql_fetch_array($q)){
	$pdf->Cell(15, 0.8, "Total", 1, 0,'C');		
	$pdf->Cell(2.5, 0.8, $c['totalvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($c['totalbiaya'])." ,-", 1, 0,'C');		
	$pdf->Cell(2, 0.8, number_format($totalvolumekm2,2)."L", 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format($totalkmhari2,2)."KM", 1, 0,'C');
	$pdf->Cell(2, 0.8,"Rp. ".number_format($totalhargarata2)." ,-", 1, 1,'C');	
}




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
$pdf->Cell(25.5,0.7,"Rekap Data Kendaraan Tragi Palangkaraya",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Rekap Bulan: ".$_GET['tanggal'],0,0,'C');
$data=$_GET['tanggal'];
$pdf->Cell(5,0.7,"Dicetak pada : ".date("d-m-Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'No. Polisi', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Merk', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tipe', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Awal', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Akhir', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Total KM', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Vol. BBM', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Biaya BBM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Volume/KM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM/Hari', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Harga Rata-rata', 1, 1, 'C');
$no=1;
$totalvolumekm3=0;
$totalkmhari3=0;
$totalhargarata3=0;
$query=mysql_query("SELECT tb_bbm.no_kendaraan, 
				  SUM(tb_bbm.volume) as jumlahvolume,
								MIN(tb_bbm.stand_km) as kmawal,
								MAX(tb_bbm.stand_km) as kmakhir,
								SUM(tb_bbm.total) as biayabbm,
								tb_kendaraan.lokasi,tb_kendaraan.merk,tb_kendaraan.tipe
								
								FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_kendaraan.lokasi='TRAGI PALANGKARAYA' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan
								GROUP BY tb_bbm.no_kendaraan");
while($b=mysql_fetch_array($query)){
	$awal=$b['kmawal'];
	$akhir=$b['kmakhir'];
	$awalakhir=$akhir-$awal;	
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['no_kendaraan'],1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['merk'], 1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['tipe'], 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['kmawal'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $b['kmakhir'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $awalakhir."KM",1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $b['jumlahvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($b['biayabbm'])." ,-",1, 0, 'C');
	$no++;
	
	

	$volume=$b['jumlahvolume'];
	$volkm=$volume/$awalakhir;
	$pdf->Cell(2, 0.8, number_format($volkm,2)."L", 1, 0,'C');
	$bulan=substr($data,1,2);
	$tahun=substr($data,4,4);
	$hari=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
	$kmhari=$awalakhir/$hari;
	$pdf->Cell(2, 0.8, number_format($kmhari,2)."KM", 1,0,'C');	
	$biayabbm=$b['biayabbm'];
	$hargarata=$biayabbm/$volume;
	$pdf->Cell(2, 0.8,"Rp. ".number_format($hargarata)." ,-",1, 1, 'C');
	$totalvolumekm3=$totalvolumekm3+$volkm;
	$totalkmhari3=$totalkmhari3+$kmhari;
	$totalhargarata3=$totalhargarata3+$hargarata;
}

$q=mysql_query("SELECT SUM(tb_bbm.volume) as totalvolume,
					SUM(tb_bbm.total) as totalbiaya,
					MIN(tb_bbm.stand_km) as totalkmawal,
					MAX(tb_bbm.stand_km) as totalkmakhir,
					tb_kendaraan.lokasi
					FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_bbm.no_kendaraan=tb_kendaraan.no_pol and tb_kendaraan.lokasi='TRAGI PALANGKARAYA' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan");
while($c=mysql_fetch_array($q)){
	$pdf->Cell(15, 0.8, "Total", 1, 0,'C');		
	$pdf->Cell(2.5, 0.8, $c['totalvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($c['totalbiaya'])." ,-", 1, 0,'C');		
	$pdf->Cell(2, 0.8, number_format($totalvolumekm3,2)."L", 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format($totalkmhari3,2)."KM", 1, 0,'C');
	$pdf->Cell(2, 0.8,"Rp. ".number_format($totalhargarata3)." ,-", 1, 1,'C');	
}


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
$pdf->Cell(25.5,0.7,"Rekap Data Kendaraan Tragi Barabai",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Rekap Bulan: ".$_GET['tanggal'],0,0,'C');
$data=$_GET['tanggal'];
$pdf->Cell(5,0.7,"Dicetak pada : ".date("d-m-Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'No. Polisi', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Merk', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tipe', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Awal', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Akhir', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Total KM', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Vol. BBM', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Biaya BBM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Volume/KM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM/Hari', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Harga Rata-rata', 1, 1, 'C');
$no=1;
$totalvolumekm5=0;
$totalkmhari5=0;
$totalhargarata5=0;
$query=mysql_query("SELECT tb_bbm.no_kendaraan, 
				  SUM(tb_bbm.volume) as jumlahvolume,
								MIN(tb_bbm.stand_km) as kmawal,
								MAX(tb_bbm.stand_km) as kmakhir,
								SUM(tb_bbm.total) as biayabbm,
								tb_kendaraan.lokasi,tb_kendaraan.merk,tb_kendaraan.tipe
								
								FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_kendaraan.lokasi='TRAGI BARABAI' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan
								GROUP BY tb_bbm.no_kendaraan");
while($b=mysql_fetch_array($query)){
	$awal=$b['kmawal'];
	$akhir=$b['kmakhir'];
	$awalakhir=$akhir-$awal;
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['no_kendaraan'],1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['merk'], 1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['tipe'], 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['kmawal'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $b['kmakhir'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $awalakhir."KM",1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $b['jumlahvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($b['biayabbm'])." ,-",1, 0, 'C');
	$no++;
	
	

	$volume=$b['jumlahvolume'];
	$volkm=$volume/$awalakhir;
	$pdf->Cell(2, 0.8, number_format($volkm,2)."L", 1, 0,'C');
	$bulan=substr($data,1,2);
	$tahun=substr($data,4,4);
	$hari=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
	$kmhari=$awalakhir/$hari;
	$pdf->Cell(2, 0.8, number_format($kmhari,2)."KM", 1,0,'C');	
	$biayabbm=$b['biayabbm'];
	$hargarata=$biayabbm/$volume;
	$pdf->Cell(2, 0.8,"Rp. ".number_format($hargarata)." ,-",1, 1, 'C');
	$totalvolumekm5=$totalvolumekm5+$volkm;
	$totalkmhari5=$totalkmhari5+$kmhari;
	$totalhargarata5=$totalhargarata5+$hargarata;
}

$q=mysql_query("SELECT SUM(tb_bbm.volume) as totalvolume,
					SUM(tb_bbm.total) as totalbiaya,
					MIN(tb_bbm.stand_km) as totalkmawal,
					MAX(tb_bbm.stand_km) as totalkmakhir,
					tb_kendaraan.lokasi
					FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_bbm.no_kendaraan=tb_kendaraan.no_pol and tb_kendaraan.lokasi='TRAGI BARABAI' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan");
while($c=mysql_fetch_array($q)){
	$pdf->Cell(15, 0.8, "Total", 1, 0,'C');		
	$pdf->Cell(2.5, 0.8, $c['totalvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($c['totalbiaya'])." ,-", 1, 0,'C');		
	$pdf->Cell(2, 0.8, number_format($totalvolumekm5,2)."L", 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format($totalkmhari5,2)."KM", 1, 0,'C');
	$pdf->Cell(2, 0.8,"Rp. ".number_format($totalhargarata5)." ,-", 1, 1,'C');	
}


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
$pdf->Cell(25.5,0.7,"Rekap Data Kendaraan Tragi Bandarmasih",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Rekap Bulan: ".$_GET['tanggal'],0,0,'C');
$data=$_GET['tanggal'];
$pdf->Cell(5,0.7,"Dicetak pada : ".date("d-m-Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'No. Polisi', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Merk', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tipe', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Awal', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM Akhir', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Total KM', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Vol. BBM', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Biaya BBM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Volume/KM', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'KM/Hari', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Harga Rata-rata', 1, 1, 'C');
$no=1;
$totalvolumekm6=0;
$totalkmhari6=0;
$totalhargarata6=0;
$query=mysql_query("SELECT tb_bbm.no_kendaraan, 
				  SUM(tb_bbm.volume) as jumlahvolume,
								MIN(tb_bbm.stand_km) as kmawal,
								MAX(tb_bbm.stand_km) as kmakhir,
								SUM(tb_bbm.total) as biayabbm,
								tb_kendaraan.lokasi,tb_kendaraan.tipe,tb_kendaraan.merk
								
								FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_kendaraan.lokasi='TRAGI BANDARMASIH' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan
								GROUP BY tb_bbm.no_kendaraan");
while($b=mysql_fetch_array($query)){
	$awal=$b['kmawal'];
	$akhir=$b['kmakhir'];
	$awalakhir=$akhir-$awal;
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['no_kendaraan'],1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['merk'], 1, 0, 'C');
	$pdf->Cell(3, 0.8,  $b['tipe'], 1, 0, 'C');
	$pdf->Cell(2, 0.8, $b['kmawal'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $b['kmakhir'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $awalakhir."KM",1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $b['jumlahvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($b['biayabbm'])." ,-",1, 0, 'C');
	$no++;
	

	$volume=$b['jumlahvolume'];
	$volkm=$volume/$awalakhir;
	$pdf->Cell(2, 0.8, number_format($volkm,2)."L", 1, 0,'C');
	$bulan=substr($data,1,2);
	$tahun=substr($data,4,4);
	$hari=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
	$kmhari=$awalakhir/$hari;
	$pdf->Cell(2, 0.8, number_format($kmhari,2)."KM", 1,0,'C');	
	$biayabbm=$b['biayabbm'];
	$hargarata=$biayabbm/$volume;
	$pdf->Cell(2, 0.8,"Rp. ".number_format($hargarata)." ,-",1, 1, 'C');
	$totalvolumekm6=$totalvolumekm6+$volkm;
	$totalkmhari6=$totalkmhari6+$kmhari;
	$totalhargarata6=$totalhargarata6+$hargarata;
}

$q=mysql_query("SELECT SUM(tb_bbm.volume) as totalvolume,
					SUM(tb_bbm.total) as totalbiaya,
					MIN(tb_bbm.stand_km) as totalkmawal,
					MAX(tb_bbm.stand_km) as totalkmakhir,
					tb_kendaraan.lokasi
					FROM tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = $data and tb_bbm.no_kendaraan=tb_kendaraan.no_pol and tb_kendaraan.lokasi='TRAGI BANDARMASIH' and tb_kendaraan.no_pol=tb_bbm.no_kendaraan");
while($c=mysql_fetch_array($q)){
	$pdf->Cell(15, 0.8, "Total", 1, 0,'C');		
	$pdf->Cell(2.5, 0.8, $c['totalvolume']."L", 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($c['totalbiaya'])." ,-", 1, 0,'C');		
	$pdf->Cell(2, 0.8, number_format($totalvolumekm6,2)."L", 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format($totalkmhari6,2)."KM", 1, 0,'C');
	$pdf->Cell(2, 0.8,"Rp. ".number_format($totalhargarata6)." ,-", 1, 1,'C');	
}
$pdf->Output("laporan_buku.pdf","I");

?>

