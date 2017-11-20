<?php 
include 'header3.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Data Transaksi</h3>
<a class="btn" href="monitor_bbm.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_transaksi=mysql_real_escape_string($_GET['no_transaksi']);
$det=mysql_query("select no_transaksi,no_kendaraan,harga,total,volume,stand_km,sopir,jenis_bbm,lokasi_beli,
							DATE_FORMAT( tb_bbm.tgl_entry,  '%d-%m-%Y' ) AS tgl_entrybaru,
							DATE_FORMAT( tb_bbm.tgl_transaksi,  '%d-%m-%Y' ) AS tgl_transaksibaru
							from tb_bbm where no_transaksi='$no_transaksi'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<table class="table">
		<tr>
			<td>Tanggal Entry</td>
			<td><?php echo $d['tgl_entrybaru'] ?></td>
		</tr>
		<tr>
			<td>Nomor Kendaraan</td>
			<td><?php echo $d['no_kendaraan'] ?> </td>
			<td><a href="det_monkendaraan.php?no_kendaraan=<?php echo $d['no_kendaraan']; ?>" class="btn btn-info">Detail Kendaraan</a></td>
		</tr>
		<tr>
			<td>Volume</td>
			<td><?php echo $d['volume'] ?></td>
		</tr>
		<tr>
			<td>Harga Perliter</td>
			<td>Rp.<?php echo number_format($d['harga']) ?>,-</td>
		</tr>
		<tr>
			<td>Total Pembelian</td>
			<td>Rp.<?php echo number_format($d['total']) ?>,-</td>
		</tr>
		<tr>
			<td>Stand KM Awal</td>
			<td><?php echo $d['stand_km'] ?>KM</td>
		</tr>
		<tr>
			<td>Sopir</td>
			<td><?php echo $d['sopir'] ?></td>
			<td><a href="det_monsopir.php?sopir=<?php echo $d['sopir']; ?>" class="btn btn-info">Detail Sopir</a></td>
		</tr>
		<tr>
			<td>Jenis BBM</td>
			<td><?php echo $d['jenis_bbm'] ?></td>
		</tr>
		<tr>
			<td>Lokasi Beli</td>
			<td><?php echo $d['lokasi_beli'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Beli</td>
			<td><?php echo $d['tgl_transaksibaru'] ?></td>
		</tr>
	</table>
 
	<?php 
}
?>
<?php include 'footer.php'; ?>