<?php 
include 'header3.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Data Transaksi</h3>
<a class="btn" href="overtank2.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_transaksi=mysql_real_escape_string($_GET['no_transaksi']);
$det=mysql_query("select DATE_FORMAT( tb_bbm.tgl_transaksi,  '%d-%m-%Y' ) AS tgl_transaksibaru,tb_bbm.no_transaksi,tb_bbm.no_kendaraan,tb_bbm.sopir,tb_bbm.volume,tb_kendaraan.kapasitas_tangki from tb_bbm,tb_kendaraan where no_transaksi='$no_transaksi' and tb_bbm.no_kendaraan=tb_kendaraan.no_pol")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<table class="table">
		<tr>
			<td>No. Transaksi</td>
			<td><?php echo $d['no_transaksi'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Beli</td>
			<td><?php echo $d['tgl_transaksibaru'] ?></td>
		</tr>
		<tr>
			<td>Nomor Kendaraan</td>
			<td><?php echo $d['no_kendaraan'] ?> </td>
			<td><a href="det_monkendaraan2.php?no_kendaraan=<?php echo $d['no_kendaraan']; ?>" class="btn btn-info">Detail Kendaraan</a></td>
		</tr>
		<tr>
			<td>Sopir</td>
			<td><?php echo $d['sopir'] ?></td>
			<td><a href="det_monsopir2.php?sopir=<?php echo $d['sopir']; ?>" class="btn btn-info">Detail Sopir</a></td>
		</tr>
		<tr>
			<td>Volume</td>
			<td><?php echo $d['volume'] ?>L</td>
		</tr>
		<tr>
			<td>Kapasitas Tangki</td>
			<td><?php echo $d['kapasitas_tangki'] ?>L</td>
		</tr>
		<tr>
			<td>Cek</td>
			<td><?php 
					if ($d['volume'] > $d['kapasitas_tangki']) 
					{
						$tes='OVER TANK';
						echo "<h5> <a style='color:red'> ". $tes."</a></h5>";
					}
					else 
					{
						echo "ON TANK";
					} ?></td>
		</tr>
	</table>
 
	<?php 
}
?>
<?php include 'footer.php'; ?>