<?php 
include 'config.php';
$id_sppd=$_GET['id_sppd'];
mysql_query("delete from tb_sppd where id_sppd=$id_sppd");
header("location:monitor_sppd.php");

?>