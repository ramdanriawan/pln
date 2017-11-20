<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Data Kendaraan</h3>
<a class="btn" href="kendaraan.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$no_pol=mysql_real_escape_string($_GET['no_pol']);
$det=mysql_query("select * from tb_kendaraan where no_pol='$no_pol'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="update_kendaraan.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="no_pol" value="<?php echo $d['no_pol'] ?>"></td>
			</tr>
			<tr>
				<td>Nomor Polisi</td>
				<td><input type="text" class="form-control" name="no_pol" value="<?php echo $d['no_pol'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Merk</td>
				<td><input type="text" class="form-control" name="merk" value="<?php echo $d['merk'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Tipe</td>
				<td><input type="text" class="form-control" name="tipe" value="<?php echo $d['tipe'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Warna</td>
				<td><input type="text" class="form-control" name="warna" value="<?php echo $d['warna'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Peruntukkan</td>
				<td><input type="text" class="form-control" name="peruntukkan" value="<?php echo $d['peruntukkan'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Lokasi</td>
				<td><input type="text" class="form-control" name="lokasi" value="<?php echo $d['lokasi'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Harga Sewa</td>
				<td><input type="text" class="form-control" name="hrg_sewa" value="<?php echo $d['hrg_sewa'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Nomor Rangka</td>
				<td><input type="text" class="form-control" name="no_rangka" value="<?php echo $d['no_rangka'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Nomor Mesin</td>
				<td><input type="text" class="form-control" name="no_mesin" value="<?php echo $d['no_mesin'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Bahan Bakar</td>
				<td><input type="text" class="form-control" name="bahan_bakar" value="<?php echo $d['bahan_bakar'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Kapasitas Tangki</td>
				<td><input type="text" class="form-control" name="kapasitas_tangki" value="<?php echo $d['kapasitas_tangki'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Tahun Kendaraan</td>
				<td><input type="text" class="form-control" name="tahun_kendaraan" value="<?php echo $d['tahun_kendaraan'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
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

<?php include 'footer.php'; ?>