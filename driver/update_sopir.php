<?php 
include 'config.php';
$idsopir=$_POST['idsopir'];
$nama=$_POST['nama'];
$ttl=$_POST['ttl'];
$jk=$_POST['jk'];
$jabatan=$_POST['jabatan'];
$no_hp=$_POST['no_hp'];
$alamat=$_POST['alamat'];

mysql_query("update tb_sopir set nama='$nama', ttl='$ttl', jk='$jk', jabatan='$jabatan', no_hp='$no_hp', alamat='$alamat' where idsopir='$idsopir'");
header("location:sopir.php");

?>