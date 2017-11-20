<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  DETAIL SPPD</h3>
<div class="text-left">
	<a href="cetak_permohonan.php" class="btn btn-default btn-xs">Back</a>
</div>
<?php
$q = mysql_query("select a.*, b.tipe from tb_sppd a left join tb_kendaraan b on a.no_pol = b.no_pol where a.no_permohonan = ".$_GET['no_permohonan']);
if($q){
	$data = mysql_fetch_array($q);
	?>
	<style type="text/css">
	.subtitle{
		width: 100%;
		border-bottom: 1px solid #C6C6C6;
		font-style: italic;
		padding: 0;
		font-size: 120%;
		}

.table-borderless tbody tr td,
.table-borderless tbody tr th,
.table-borderless thead tr th,
.table-borderless thead tr td,
.table-borderless tfoot tr th,
.table-borderless tfoot tr td {
    border: none;
}
		</style>
	<h3 class="subtitle">Data SPPD</h3>
	<table class="table table-borderless">
		<tr>
			<td width="25%">Driver</td>
			<td><?php echo $data['nama_sopir']?></td>
		</tr>
		<tr>
			<td>No Pol</td>
			<td><?php echo $data['no_pol']?> - <?php echo $data['tipe']?></td>
		</tr>
	</table>

	<?php
	$qp = mysql_query("select * from tb_permohonan where no_permohonan = ".$_GET['no_permohonan']);
	$datap = mysql_fetch_array($qp);
	?>
	<h3 class="subtitle">Data Permohonan</h3>
	<table class="table table-borderless">
		<tr>
			<td width="25%">Nomor Permohonan</td>
			<td><?php echo $datap['no_permohonan']?></td>
		</tr>
		<tr>
			<td width="25%">Nama</td>
			<td><?php echo $datap['nama']?></td>
		</tr>
		<tr>
			<td>Bagian</td>
			<td><?php echo $datap['bagian']?></td>
		</tr>
		<tr>
			<td>Jumlah Penumpang</td>
			<td><?php echo $datap['jumlah_penumpang']?></td>
		</tr>
		<tr>
			<td>Hari, Tanggal Awal</td>
			<td><?php echo ($datap['hari_tgl'])?></td>
		</tr>
		<tr>
			<td>Hari, Tanggal Akhir</td>
			<td><?php echo ($datap['hari_tglakhir'])?></td>
		</tr>
		<tr>
			<td>Jam Awal</td>
			<td><?php echo ($datap['jam_awal'])?></td>
		</tr>
		<tr>
			<td>Jam Akhir</td>
			<td><?php echo ($datap['jam_akhir'])?></td>
		</tr>
		<tr>
			<td>Tujuan</td>
			<td><?php echo $datap['tujuan']?></td>
		</tr>
		<tr>
			<td>Keperluan</td>
			<td><?php echo $datap['keperluan']?></td>
		</tr>
	</table>
	
	<?php
}
?>
<script type="text/javascript" src="../assets/js/jquery-1.7.2.js"></script>
  <script type="text/javascript" src="../assets/ui/jquery.ui.core.js"></script>
  <script type="text/javascript" src="../assets/ui/jquery.ui.datepicker.js"></script>
  <script type="text/javascript" src="../assets/ui/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript">

$(document).ready(function(){

$("#dtp,#dtp2").datepicker({

dateFormat: "DD, dd MM yy",showOn: "button",
buttonImage: "../assets/img/cal.gif",
buttonImageOnly: true

});

});

</script>

<link rel="stylesheet" media="all" type="text/css" href="../assets/ui/jquery-date-time-picker/jquery-ui.css" />
 <link rel="stylesheet" media="all" type="text/css" href="../assets/ui/jquery-date-time-picker/jquery-ui-timepicker-addon.css" />
 <script type="text/javascript" src="../assets/ui/jquery-date-time-picker/jquery-ui-timepicker-addon.js"></script>
 <script type="text/javascript" src="../assets/ui/jquery-date-time-picker/jquery-ui-sliderAccess.js"></script>
  <script>
  
 $('#jamawal,#jamakhir').timepicker({
 timeFormat: 'HH:mm:ss',
 stepHour: 1,
 stepMinute: 1,
 stepSecond: 1,
 });
  </script>

<?php include 'footer.php'; ?>