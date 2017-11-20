<?php 
include 'config.php';
$nama=$_GET['nama'];
mysql_query("delete from tb_sopir where nama='$nama'");
header("location:sopir.php");

?>