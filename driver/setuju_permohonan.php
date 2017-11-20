<?php 
//include 'monitor_permohonan.php';
// $status=$_GET['status'];
// //ambil aksi
// $act = $_GET['confirm'];
// //jika aksi = input
// switch($act){
// 	case "input"
// 		$result = mysql_query("INSERT INTO tb_status(status)VALUES('','$_POST[status]')");
// }
	session_start();
	include 'config.php';
$sql = "update tb_permohonan set status = 'approved', menyetujui = '".$_SESSION['username']."' where no_permohonan = ".$_GET['no_permohonan'];
mysql_query($sql);
header("location:cetak_permohonan.php");

?>
