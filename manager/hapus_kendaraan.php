<?php 
include 'config.php';
$no_pol=$_GET['no_pol'];
mysql_query("delete from tb_kendaraan where no_pol='$no_pol'");
header("location:kendaraan.php");

?>