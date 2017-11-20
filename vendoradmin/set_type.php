<?php 
include 'config.php';
$no_permohonan=$_GET['no_permohonan'];
$type=$_GET['type'];
mysql_query("update tb_permohonan set `type` = '$type' where no_permohonan = $no_permohonan");
header("location:monitor_permohonan.php");

?>