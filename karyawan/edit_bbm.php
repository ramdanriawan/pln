<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit --- BBM </h3>
<a class="btn" href="entry_bbm.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_transaksi=mysql_real_escape_string($_GET['no_transaksi']);
$no=1;
$det=mysql_query("select * from tb_bbm where no_transaksi='$no_transaksi'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<form action="update_bbm.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="no_transaksi" value="<?php echo $d['no_transaksi'] ?>"></td>
			</tr>
			<tr>
				<td>Nomor Transaksi</td>
				<td><input name="no_transaksi" type="text" readonly class="form-control" id="no_transaksi" value="<?php echo $d['no_transaksi'] ?>" autocomplete="off" onkeypress='return isNumberKeyTrue(event)' onPaste='false'></td>
			</tr>
			<tr>
				<td>Tanggal Entry</td>
				<td><input name="tgl_entry" type="text" readonly class="form-control" id="tgl_entry" value="<?php echo $d['tgl_entry'] ?>" autocomplete="off" onkeypress='return isNumberKeyTrue(event)' onPaste='false'></td></td>
			</tr>
			<tr>
				<td>Nomor Kendaraan</td>
				<td>
					<select class="form-control" name="no_kendaraan" onkeypress='return isNumberKeyTrue(event)' onPaste='false'>
								<?php 
								$brg=mysql_query("select * from tb_kendaraan");
								while($b=mysql_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['no_pol']; ?>"><?php echo $b['no_pol'] ?></option>
									<?php 
								}
								?>
					</select>
				</td>
				</tr>
			<tr>
				<td>Harga</td>
				<td><input name="harga" type="text" class="form-control" id="harga" autocomplete="off" value="<?php echo $d['harga'] ?>" onkeypress='return isNumberKeyTrue(event)' onPaste='false'></td>
			</tr>
			<tr>
				<td>Total</td>
				<td><input name="total" type="text" class="form-control" id="total" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" value="<?php echo $d['total'] ?>"></td>
			</tr>
			<tr>
				<td>Stand KM</td>
				<td><input name="stand_km" type="text" class="form-control" id="stand_km" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" value="<?php echo $d['stand_km'] ?>"></td>
			</tr>
			<tr>
				<td>Sopir</td>
				<td>
					<select class="form-control" name="sopir" onkeypress='return isNumberKeyTrue(event)' onPaste='false'>
								<?php 
								$brg=mysql_query("select * from tb_sopir");
								while($b=mysql_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['nama']; ?>"><?php echo $b['nama'] ?></option>
									<?php 
								}
								?>
							</select>
				</td>
			</tr>		
			<tr>
				<td>Jenis BBM</td>
				<td>
				<select class="form-control" name="jenis_bbm" onkeypress='return isNumberKeyTrue(event)' onPaste='false'>
							  <option value="premium">PREMIUM</option>
							  <option value="pertamax">PERTAMAX</option>
							  <option value="pertalite">PERTALITE</option>
							  <option value="solar">SOLAR</option>
							</select></td>
			</tr>
			<tr>
				<td>Lokasi Beli</td>
				<td><input type="text" class="form-control" name="lokasi_beli" onkeypress='return isNumberKeyTrue(event)' onPaste='false' value="<?php echo $d['lokasi_beli'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Tanggal Beli</td>
				<td><input name="tgl_transaksi" type="text" class="form-control" id="tgl_transaksi" onkeypress='return isNumberKeyTrue(event)' onPaste='false' autocomplete="off" value="<?php echo $d['tgl_transaksi'] ?>"></td>
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
	<script type="text/javascript" src="../assets/ui/jquery-ui-1.8.19.custom.js"></script>
  <script type="text/javascript" src="../assets/ui/ui.core.js"></script>
  <script type="text/javascript" src="../assets/ui/ui.datepicker.js"></script>
  <script type="text/javascript" src="../assets/ui/ui.datepicker-id.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
  $("#dtp").datepicker();
  });
  </script>
<?php 
include 'footer.php';

?>