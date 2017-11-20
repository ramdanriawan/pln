<?php 
include 'header2.php';
?>

<?php
$a = mysql_query("select * from tb_kendaraan");
?>

<div class="col-md-10">
	<h1><center>Selamat datang</center></h1>
	<h1><center>Permohonan Pinjam Kendaraan Dinas</center></h1>
	<h1><center>PT PLN (PERSERO) AP2B SISTEM KALSELTENG</center></h1>
</div>
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';

?>