<?php 
include 'config.php';
$nama=$_POST['nama'];
$foto=$_FILES['foto']['name'];

// move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name'])or die();
// 	mysql_query("update admin set foto='$foto' where uname='$user'");


$u=mysql_query("select * from tb_sopir where nama='$nama'");
$us=mysql_fetch_array($u);
if(file_exists("foto/".$us['foto'])){
	unlink("foto/".$us['foto']);
	move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
	mysql_query("update admin set foto='$foto' where uname='$user'");
	header("location:kendaraan.php");
}else{
	move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
	mysql_query("update admin set foto='$foto' where uname='$user'");
	header("location:kendaraan.php");
}
?>
