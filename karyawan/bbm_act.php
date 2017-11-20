<?php 

include 'config.php';
$no_transaksi=$_POST['no_transaksi'];
$tgl_transaksi=$_POST['tgl_transaksi'];
$no_kendaraan=$_POST['no_kendaraan'];
$harga=$_POST['harga'];
$total=$_POST['total'];
$pembagian=$total/$harga;
$stand_km=$_POST['stand_km'];
$sopir=$_POST['sopir'];
$jenis_bbm=$_POST['jenis_bbm'];
$besarbbm=strtoupper($jenis_bbm);
$lokasi_beli=$_POST['lokasi_beli'];
$tgl_entry=date('Y-m-d');

mysql_query("insert into tb_bbm values('$no_transaksi','$tgl_transaksi','$no_kendaraan','$pembagian','$harga','$total','$stand_km','$sopir','$besarbbm','$lokasi_beli','$tgl_entry')")or die(mysql_error());
header("location:entry_bbm.php");

?>