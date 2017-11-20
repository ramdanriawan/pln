<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  PERMOHONAN PINJAM KENDARAAN DINAS</h3>
<?php
$username=$_SESSION['username'];
$det=mysql_query("select * from tb_login where username='$username'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="simpan_end_trip.php" method="post">
	<input type="hidden" name="no_permohonan" value="<?php echo $_GET['no_permohonan']?>">
		<table class="table">

			<tr>
				<td>Hari & Tanggal Awal</td>
				<td><input name="tanggal_awal" type="text" class="form-control" id="dtp" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" required="required" onchange="days();"></td>
			</tr>
			<tr>
				<td>Hari & Tanggal Akhir</td>
				<td><input name="tanggal_akhir" type="text" class="form-control" id="dtp2" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" required="required" onchange="days();"></td>
			</tr>
			<tr>
				<td>Jumlah Hari</td>
				<td><input name="jumlah_hari" type="text" class="form-control" id="jumlah_hari" readonly="readonly"></td>
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
function days() {
	if($("#dtp").val()=="" || $("#dtp2").val()==""){
		$("#jumlah_hari").val("");
		return false;
	}

    var a = $("#dtp").datepicker('getDate').getTime(),
        b = $("#dtp2").datepicker('getDate').getTime(),
        c = 24*60*60*1000,
        diffDays = Math.round(Math.abs((a - b)/(c)));

      
	$("#jumlah_hari").val(diffDays+1);
    console.log(diffDays+1); //show difference
}
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