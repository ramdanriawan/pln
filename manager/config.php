<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect("localhost","root");
mysql_select_db("db_pln");
$connection = mysqli_connect("localhost","root","","db_pln");
?>