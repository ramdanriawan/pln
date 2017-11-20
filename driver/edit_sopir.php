<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Data Sopir</h3>
<a class="btn" href="sopir.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$nama=mysql_real_escape_string($_GET['nama']);
$det=mysql_query("select * from tb_sopir where nama='$nama'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="update_sopir.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="nama" value="<?php echo $d['nama'] ?>"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $d['nama'] ?>"></td>
			</tr>
			<tr>
				<td>Tempat Tanggal Lahir</td>
				<td><input type="text" class="form-control" name="ttl" value="<?php echo $d['ttl'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td><input type="text" class="form-control" name="jk" value="<?php echo $d['jk'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td><input type="text" class="form-control" name="jabatan" value="<?php echo $d['jabatan'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Nomor Kontak</td>
				<td><input type="text" class="form-control" name="no_hp" value="<?php echo $d['no_hp'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><input type="text" class="form-control" name="alamat" value="<?php echo $d['alamat'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
			</tr>
			<tr>
				<td>Gaji Yang Diterima</td>
				<td><input type="text" class="form-control" name="alamat" value="<?php echo $d['gaji_diterima'] ?>" onkeyup="this.value = this.value.toUpperCase()"></td>
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