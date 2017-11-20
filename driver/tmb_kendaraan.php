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
$foto=$_POST['foto'];
mysql_query("insert into tb_kendaraan values ('$no_pol','$merk','$tipe','$warna','$peruntukkan','$lokasi','$hrg_sewa','$no_rangka','$no_mesin','$bahan_bakar','$kapasitas_tangki','$tahun_kendaraan','$foto')")or die(mysql_error());
header("location:kendaraan.php");
?>