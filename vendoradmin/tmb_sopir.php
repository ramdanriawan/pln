<?php 
include 'config.php';
$nama=$_POST['nama'];
$ttl=$_POST['ttl'];
$jk=$_POST['jk'];
$jabatan=$_POST['jabatan'];
$no_hp=$_POST['no_hp'];
$alamat=$_POST['alamat'];
$gaji=$_POST['gaji']

mysql_query("insert into tb_sopir values('$nama','$ttl','$jk','$jabatan','$no_hp','$alamat','$gaji','')")or die(mysql_error());
header("location:sopir.php");

 ?>