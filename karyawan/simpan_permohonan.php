<?php 

include 'config.php';
$no_permohonan    = $_POST['no_permohonan'];
$nama             = $_POST['nama'];
$bagian           = $_POST['bagian'];
$jumlah_penumpang = $_POST['jumlah_penumpang'];
$hari_tgl         = $_POST['dtp'];
$hari_tglakhir    = $_POST['dtp2'];
$jam_awal         = $_POST['jamawal'];
$jam_akhir        = $_POST['jamakhir'];
$tujuan           = $_POST['tujuan'];
$keperluan        = $_POST['keperluan'];

$sql = "insert into tb_permohonan 
values('$no_permohonan','$nama','$bagian','$jumlah_penumpang','$hari_tgl','$hari_tglakhir','$jam_awal','$jam_akhir','$tujuan','$keperluan','','','','','','','pending','','',0)";

mysql_query($sql) or die(mysql_error());
header("location:form_permohonan.php");

?>