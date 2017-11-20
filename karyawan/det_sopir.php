<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Data Sopir</h3>
<a class="btn" href="sopir.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$nama=mysql_real_escape_string($_GET['nama']);
$det=mysql_query("select * from tb_sopir where nama='$nama'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<table class="table">
		<tr>
			<td>Nama</td>
			<td><?php echo $d['nama'] ?></td>
		</tr>
		<tr>
			<td>Tempat Tanggal Lahir</td>
			<td><?php echo $d['ttl'] ?></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td><?php echo $d['jk'] ?></td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td><?php echo $d['jabatan'] ?></td>
		</tr>
		<tr>
			<td>Nomor Kontak</td>
			<td><?php echo $d['no_hp'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?php echo $d['alamat'] ?></td>
		</tr>
		<tr>
			<td>Gaji yang Diterima</td>
			<td>Rp.<?php echo number_format($d['gaji_diterima']) ?>,-</td>
		</tr>
		<tr>
			<td>Foto</td>
			<td> <img src="foto/<?php echo $d['Foto']; ?>" border="0"/> </td>
			
		</tr>
	</table>
 
	<?php 
}
?>
<?php include 'footer.php'; ?>