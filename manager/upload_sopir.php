<?php 
include 'config.php';
$nama=$_POST['nama'];
$Foto=$_FILES['Foto']['name'];

$u=mysql_query("select * from tb_sopir where nama='$nama'");
$us=mysql_fetch_array($u);
if(file_exists("foto/".$us['Foto'])){
	unlink("foto/".$us['Foto']);
	move_uploaded_file($_FILES['Foto']['tmp_name'], "foto/".$_FILES['Foto']['name']);
	mysql_query("update tb_sopir set Foto='$Foto' where nama='$nama'");
	header("location:sopir.php");
}else{
	move_uploaded_file($_FILES['Foto']['tmp_name'], "foto/".$_FILES['Foto']['name']);
	mysql_query("update tb_sopir set Foto='$Foto' where nama='$nama'");
	header("location:sopir.php");
}
?>
