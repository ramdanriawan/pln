<?php 
include 'config.php';
$no_permohonan=$_GET['no_permohonan'];
mysql_query("delete from tb_permohonan where no_permohonan=$no_permohonan");
header("location:cetak_permohonan.php");
?>