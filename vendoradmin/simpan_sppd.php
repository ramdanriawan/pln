<?php 

include 'config.php';
$no_permohonan=$_POST['no_permohonan'];
$nama_sopir=$_POST['nama_sopir'];
// $tanggal_pergi=$_POST['tanggal_pergi'];
// $tanggal_kembali=$_POST['tanggal_kembali'];
// $biaya_harian=$_POST['biaya_harian'];
// $biaya_penginapan=$_POST['biaya_penginapan'];
// $total=$_POST['total'];
// $nama_mobil=$_POST['nama_mobil'];
$no_pol=$_POST['no_pol'];

$sql = "insert into tb_sppd(no_permohonan, nama_sopir,no_pol) 
values('$no_permohonan','$nama_sopir','$no_pol')";
mysql_query($sql) or die(mysql_error());

$sql = "update tb_kendaraan set `status` = 'in use' where no_pol = '".$no_pol."'";
mysql_query($sql) or die(mysql_error());

$sql = "update tb_sopir set `status` = 'in use' where nama_sopir = '".$nama_sopir."'";
mysql_query($sql) or die(mysql_error());

$sql = "update tb_permohonan set  `no_pol` = '$no_pol' where no_permohonan = ".$no_permohonan;
mysql_query($sql) or die(mysql_error());

header("location:cetak_permohonan.php");

?>