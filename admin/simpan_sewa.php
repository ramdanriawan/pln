<?php 

include 'config.php';
$no_permohonan=$_POST['no_permohonan'];
$driver=$_POST['driver'];
$tanggal_pergi=$_POST['tanggal_pergi'];
$tanggal_kembali=$_POST['tanggal_kembali'];
$biaya_harian=$_POST['biaya_harian'];
$biaya_penginapan=$_POST['biaya_penginapan'];
$total=$_POST['total'];
//$nama_mobil=$_POST['nama_mobil'];
$no_pol=$_POST['no_pol'];

$sql = "insert into tb_sewa(no_permohonan, driver, tanggal_pergi, tanggal_kembali, biaya_harian, biaya_penginapan,total,no_pol) 
values('$no_permohonan','$driver','$tanggal_pergi','$tanggal_kembali','$biaya_harian','$biaya_penginapan','$total','$no_pol')";
mysql_query($sql) or die(mysql_error());


$sql = "update tb_kendaraan set `status` = 'in use' where no_pol = '".$no_pol."'";
mysql_query($sql) or die(mysql_error());


$sql = "update tb_permohonan set `type` = 'SEWA', `no_pol` = '$no_pol' where no_permohonan = ".$no_permohonan;
mysql_query($sql) or die(mysql_error());

header("location:cetak_permohonan.php");

?>