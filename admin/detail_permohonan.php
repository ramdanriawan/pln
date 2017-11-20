<?php 
include 'header2.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  PERMOHONAN PINJAM KENDARAAN DINAS</h3>
<?php
$username=$_SESSION['username'];
$det=mysql_query("select * from tb_login where username='$username'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="?" method="post">
					<?php 
							$query=mysql_query("SELECT * from tb_permohonan where no_permohonan = ".$_GET['no_permohonan'] );

							$data=mysql_fetch_array($query));
							

					?>
		<table class="table">
			<tr>
				<td>No. Permohonan</td>
				<td><input type="text" readonly class="form-control" name="no_permohonan" value="<?php echo $data['no_permohonan'] ?>"  ></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $data['nama'] ?>"  ></td>
			</tr>
			<tr>
				<td>Bagian</td>
				<td><input type="text" class="form-control" name="bagian" <?php echo $data['bagian'] ?>></td>
			</tr>
			<tr>
				<td>Jumlah Penumpang (Orang)</td>
				<td><input type="number" class="form-control" name="jumlah_penumpang" value="<?php echo $data['jumlah_penumpang'] ?>" ></td>
			</tr>
			<tr>
				<td>Hari & Tanggal Awal</td>
				<td><input name="dtp" type="text" class="form-control" id="dtp" value="<?php echo $data['hari_tgl'] ?>"></td>
			</tr>
			<tr>
				<td>Hari & Tanggal Akhir</td>
				<td><input name="dtp2" type="text" class="form-control" id="dtp2" value="<?php echo $data['hari_tglakhir'] ?>" ></td>
			</tr>
			<tr>
				<td>Jam Awal</td>
				<td><input name="jamawal" type="text" class="form-control" id="jamawal" value="<?php echo $data['jam_awal'] ?>" ></td>
			</tr>
			<tr>
				<td>Jam Akhir</td>
				<td><input name="jamakhir" type="text" class="form-control" id="jamakhir" value="<?php echo $data['jam_akhir'] ?>" ></td>
			</tr>
			<tr>
				<td>Tujuan</td>
				<td><input type="text" class="form-control" name="tujuan" value="<?php echo $data['tujuan'] ?>" ></td>
			</tr>
			<tr>
				<td>Keperluan</td>
				<td><input type="text" class="form-control" name="keperluan" value="<?php echo $data['keperluan'] ?>" ></td>
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


<?php include 'footer.php'; ?>