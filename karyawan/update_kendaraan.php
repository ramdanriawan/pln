<?php 
include 'config.php';
$no_pol=$_POST['no_pol'];
$merk=$_POST['merk'];
$tipe=$_POST['tipe'];
$warna=$_POST['warna'];
$peruntukkan=$_POST['peruntukkan'];
$lokasi=$_POST['lokasi'];
$hrg_sewa=$_POST['hrg_sewa'];
$no_rangka=$_POST['no_rangka'];
$no_mesin=$_POST['no_mesin'];
$bahan_bakar=$_POST['bahan_bakar'];
$kapasitas_tangki=$_POST['kapasitas_tangki'];
$tahun_kendaraan=$_POST['tahun_kendaraan'];

mysql_query("update tb_kendaraan set merk='$merk', tipe='$tipe', warna='$warna', peruntukkan='$peruntukkan', lokasi='$lokasi', hrg_sewa='$hrg_sewa', no_rangka='$no_rangka', no_mesin='$no_mesin', bahan_bakar='$bahan_bakar', kapasitas_tangki='$kapasitas_tangki', tahun_kendaraan='$tahun_kendaraan' where no_pol='$no_pol'");
header("location:kendaraan.php");

?>