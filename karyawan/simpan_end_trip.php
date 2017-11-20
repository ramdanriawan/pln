<?php 

include 'config.php';
$no_permohonan = $_POST['no_permohonan'];
$tanggal_awal=$_POST['tanggal_awal'];
$tanggal_akhir=$_POST['tanggal_akhir'];
$jumlah_hari=$_POST['jumlah_hari'];

//get data sppd
$qsppd = mysql_query("select * from tb_sppd where no_permohonan = ".$no_permohonan);
$datasppd = mysql_fetch_array($qsppd);

$biaya_harian = 96000;
$biaya_penginapan = 80000;

//hitung biaya harian
$total_biaya_harian = $biaya_harian*$jumlah_hari;

//hitung biaya penginapan
$total_biaya_penginapan = 0;
if($jumlah_hari>1){
$total_biaya_penginapan = ($jumlah_hari-1)*$biaya_penginapan;
}

$total_biaya = $total_biaya_harian+$total_biaya_penginapan;

$sql = "update  tb_sppd 
set 
tanggal_awal = '$tanggal_awal',
tanggal_akhir = '$tanggal_akhir',
jumlah_hari = $jumlah_hari,
biaya_harian = '$total_biaya_harian',
biaya_penginapan = '$total_biaya_penginapan',
total_biaya = '$total_biaya'
where

no_permohonan = $no_permohonan
";

// /echo $sql;exit;
mysql_query($sql) or die(mysql_error());




//update kendaraan
mysql_query("update tb_kendaraan set status = 'available' where no_pol = '".$datasppd['no_pol']."'");

//update sopi
mysql_query("update tb_sopir set status = 'available' where nama_sopir = '".$datasppd['nama_sopir']."'");


//update permohonan
$sql = "update  tb_permohonan 
set 
end = 1
where

no_permohonan = $no_permohonan
";

mysql_query($sql) or die(mysql_error());
header("location:cetak_permohonan.php");

?>