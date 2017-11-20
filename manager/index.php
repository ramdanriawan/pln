<?php 
include 'header.php';
?>

<?php
$a = mysql_query("select * from tb_permohonan");
?>

<div class="col-md-10">
	<h1><center>Selamat datang</center></h1>
	<h2><center>APLIKASI </center></h2>
	<h2><center>PENGENDALIAN BBM & PERMOHONAN PINJAM KENDARAAN DINAS</center></h2>
	<h2><center>& </center></h2>
	<h2><center>PERMOHONAN PINJAM KENDARAAN DINAS</center></h2>
	<h1><center>PT PLN (PERSERO) AP2B SISTEM KALSELTENG</center></h1>

</div>
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';

?>