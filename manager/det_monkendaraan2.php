<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Data Kendaraan</h3>
<a class="btn" href="overtank2.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_pol=mysql_real_escape_string($_GET['no_kendaraan']);


$det=mysql_query("select * from tb_kendaraan where no_pol='$no_pol'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<table class="table">
		<tr>
			<td>Nomor Polisi</td>
			<td><?php echo $d['no_pol'] ?></td>
		</tr>
		<tr>
			<td>Merk</td>
			<td><?php echo $d['merk'] ?></td>
		</tr>
		<tr>
			<td>Tipe</td>
			<td><?php echo $d['tipe'] ?></td>
		</tr>
		<tr>
			<td>Warna</td>
			<td><?php echo $d['warna'] ?></td>
		</tr>
		<tr>
			<td>Peruntukkan</td>
			<td><?php echo $d['peruntukkan'] ?></td>
		</tr>
		<tr>
			<td>Harga Sewa</td>
			<td>Rp.<?php echo number_format($d['hrg_sewa']) ?>,-</td>
		</tr>
		<tr>
			<td>Nomor Rangka</td>
			<td><?php echo $d['no_rangka'] ?></td>
		</tr>
		<tr>
			<td>Nomor Mesin</td>
			<td><?php echo $d['no_mesin'] ?></td>
		</tr>
		<tr>
			<td>Bahan Bakar</td>
			<td><?php echo $d['bahan_bakar'] ?></td>
		</tr>
		<tr>
			<td>Kapasitas Tangki</td>
			<td><?php echo $d['kapasitas_tangki'] ?>L</td>
		</tr>
		<tr>
			<td>Tahun Kendaraan</td>
			<td><?php echo $d['tahun_kendaraan'] ?></td>
		</tr>
		<tr>
			<td>Foto</td>
			<td><?php echo $d['foto'] ?></td>
		</tr>
	</table>
	<?php 
}
?>
<?php include 'footer.php'; ?>