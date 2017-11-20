<?php 
include 'config.php';
$no_transaksi=$_POST['no_transaksi'];
$tgl_entry=date('Y-m-d');
$no_kendaraan=$_POST['no_kendaraan'];
$total=$_POST['total'];
$harga=$_POST['harga'];
$pembagian=$total/$harga;
$stand_km=$_POST['stand_km'];
$sopir=$_POST['sopir'];
$besarsopir=strtoupper($sopir);
$jenis_bbm=$_POST['jenis_bbm'];
$besarbbm=strtoupper($jenis_bbm);
$lokasi_beli=$_POST['lokasi_beli'];
$besarlokasi=strtoupper($lokasi_beli);
$tgl_transaksi=$_POST['tgl_transaksi'];

mysql_query("update tb_bbm set tgl_transaksi='$tgl_transaksi', no_kendaraan='$no_kendaraan', volume='$pembagian', harga='$harga', total='$total', stand_km='$stand_km', sopir='$besarsopir', jenis_bbm='$besarbbm', lokasi_beli='$besarlokasi', tgl_entry='$tgl_entry' where no_transaksi='$no_transaksi'");
header("location:entry_bbm.php");
?>