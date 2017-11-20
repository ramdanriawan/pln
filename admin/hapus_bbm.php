<?php 
include 'config.php';
$no_transaksi=$_GET['no_transaksi'];
mysql_query("delete from tb_bbm where no_transaksi='$no_transaksi'");
header("location:entry_bbm.php");

?>