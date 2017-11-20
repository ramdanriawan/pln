<?php 
include 'header2.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  PERMOHONAN PINJAM KENDARAAN DINAS</h3>
<?php
$username=$_SESSION['username'];
$det=mysql_query("select * from tb_login where username='$username'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="simpan_permohonan.php" method="post">
		<table class="table">
			<tr>
				<td>No. Permohonan</td>
					<?php 
							$query=mysql_query("SELECT max(no_permohonan) as noakhir FROM tb_permohonan" );
							while($c=mysql_fetch_array($query)){
							$noakhir=$c['noakhir'];
							$nobaru=$noakhir+1;
							}
					?>
				<td><input type="text" readonly class="form-control" name="no_permohonan" value="<?php echo $nobaru ?>" onkeyup="this.value = this.value.toUpperCase()" required="required"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>" onkeyup="this.value = this.value()" required="required"></td>
			</tr>
			<tr>
				<td>Bagian</td>
				<td><input type="text" class="form-control" name="bagian" onkeyup="this.value = this.value.toUpperCase()" required="required"></td>
			</tr>
			<tr>
				<td>Jumlah Penumpang (Orang)</td>
				<td><input type="number" class="form-control" name="jumlah_penumpang" onkeyup="this.value = this.value()" required="required"></td>
			</tr>
			<tr>
				<td>Hari & Tanggal Awal</td>
				<td><input name="dtp" type="text" class="form-control" id="dtp" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" required="required"></td>
			</tr>
			<tr>
				<td>Hari & Tanggal Akhir</td>
				<td><input name="dtp2" type="text" class="form-control" id="dtp2" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" required="required"></td>
			</tr>
			<tr>
				<td>Jam Awal</td>
				<td><input name="jamawal" type="text" class="form-control" id="jamawal" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" required="required"></td>
			</tr>
			<tr>
				<td>Jam Akhir</td>
				<td><input name="jamakhir" type="text" class="form-control" id="jamakhir" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" required="required"></td>
			</tr>
			<tr>
				<td>Tujuan</td>
				<td><input type="text" class="form-control" name="tujuan" onkeyup="this.value = this.value.toUpperCase()" required="required"></td>
			</tr>
			<tr>
				<td>Keperluan</td>
				<td><input type="text" class="form-control" name="keperluan" onkeyup="this.value = this.value.toUpperCase()" required="required"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
			
	
		</table>
	</form>
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