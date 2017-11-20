<?php 
include 'config.php';
$no_permohonan=$_GET['no_permohonan'];

$sql="select * from tb_permohonan where no_permohonan = ".$no_permohonan;
$q=mysql_query($sql);
$data = mysql_fetch_array($q);

$no_pol = $data['no_pol'];


$q1 = mysql_query("update tb_kendaraan set `status` = '' where no_pol = '$no_pol'");


$q2 = mysql_query("delete from tb_permohonan where no_permohonan=$no_permohonan");
if($q1 && $q2){
header("location:cetak_permohonan.php");

}

?>