<?php include 'header.php';	?>
<script>function isNumberKeyTrue(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 65)
            return false;        
         return true;
      }
	 </script>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Transaksi --- BBM</h3>
<?php 
$per_hal=8;
$jumlah_record=mysql_query("SELECT COUNT(*) from tb_bbm a 		 join tb_kendaraan b on a.no_kendaraan=b.no_pol 
		 join tb_permohonan c on c.no_permohonan = a.no_transaksi
");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Jumlah Record</td>		
			<td><?php echo $jum; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>	
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
</div>
<br/>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
			<option>Pilih tanggal ..</option>
			<?php 
			$pil=mysql_query("select distinct date_format(tgl_transaksi,'%m-%Y') as bulantahun from tb_bbm");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['bulantahun'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>

</form>
<br/>
<?php 
if(isset($_GET['tanggal'])){
	$tanggal=mysql_real_escape_string($_GET['tanggal']);
	$tg="lap_bbm3.php?tanggal='$tanggal'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_bbm3.php";
}
?>

<br/>
<?php 
if(isset($_GET['tanggal'])){
	echo "<h4> Data Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
}
?>
<table class="table">
	<tr bgcolor='#FFA800'>
		<th>No. Transaksi</th>
		<th>Tanggal Entry</th>
		<th>Nomor Kendaraan</th>
		<th>Harga</th>
		<th>Total</th>		
		<th>Volume</th>		
		<th>Stand KM</th>			
		<th>Sopir</th>
		<th>Jenis BBM</th>
		<th>Lokasi Beli</th>
		<th>Tanggal Beli</th>
		<th>Opsi</th>
	</tr>
	
	<?php 
	if(isset($_GET['tanggal'])){
		$blnth=mysql_real_escape_string($_GET['tanggal']);
			$sql = "select a.*,b.lokasi,c.no_permohonan,
			DATE_FORMAT( tb_bbm.tgl_entry,  '%d-%m-%Y' ) AS tgl_entrybaru,
			DATE_FORMAT( tb_bbm.tgl_transaksi,  '%d-%m-%Y' ) AS tgl_transaksibaru
			from tb_bbm a

			left join tb_kendaraan b on a.no_kendaraan=b.no_pol
			left join tb_permohonan c on  c.no_permohonan = a.no_transaksi
			where 
			date_format(a.tgl_transaksi,'%m-%Y') = '$blnth' 
			
			";
			echo $sql;exit;
		$brg=mysql_query($sql);
	}else{
		$sql = "select a.*,b.lokasi, c.no_permohonan,
		DATE_FORMAT( a.tgl_entry,  '%d-%m-%Y' ) AS tgl_entrybaru,
		DATE_FORMAT( a.tgl_transaksi,  '%d-%m-%Y' ) AS tgl_transaksibaru ,

	 (CASE c.type 
		WHEN 'sppd_yes' THEN  (SELECT no_pol from tb_sppd where no_pol = c.no_pol)
		WHEN 'mobil_op' THEN  (SELECT no_pol from tb_sppd where no_pol = c.no_pol)
		WHEN 'sewa' THEN  (SELECT no_pol from tb_sewa where no_pol = c.no_pol)
		ELSE ''
		END)  as nomor_kendaraan,

	 (CASE c.type 
		WHEN 'sppd_yes' THEN  (SELECT driver from tb_sppd where no_pol = c.no_pol)
		WHEN 'mobil_op' THEN  (SELECT driver from tb_sppd where no_pol = c.no_pol)
		WHEN 'sewa' THEN  (SELECT driver from tb_sewa where no_pol = c.no_pol)
		ELSE ''
		END)  as driver

		from tb_bbm a
		 join tb_kendaraan b on a.no_kendaraan=b.no_pol 
		 join tb_permohonan c on c.no_permohonan = a.no_transaksi
		order by a.no_transaksi asc limit $start, $per_hal";
		
		$brg=mysql_query($sql);
	}
	while($b=mysql_fetch_array($brg)){
	
		?>
		<tr>
			<td><?php echo $b['no_permohonan']==NULL ? '-' : $b['no_permohonan'] ?></td>
			<td><?php echo $b['tgl_entrybaru'] ?></td>
			<td><?php echo $b['nomor_kendaraan'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td>Rp.<?php echo number_format($b['total']) ?>,-</td>
			<td><?php echo $b['volume'] ?> L</td>
			<td><?php echo number_format($b['stand_km']) ?> KM</td>
			<td><?php echo $b['driver'] ?></td>
			<td><?php echo $b['jenis_bbm'] ?></td>
			<td><?php echo $b['lokasi_beli'] ?></td>
			<td><?php echo $b['tgl_transaksibaru'] ?></td>
			<td>
				<a href="det_monbbm.php?no_transaksi=<?php echo $b['no_transaksi']; ?>" class="btn btn-info">Detail</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_bbm.php?no_transaksi=<?php echo $b['no_transaksi']; ?>&volume=<?php echo $b['volume'] ?>&no_kendaraan=<?php echo $b['no_kendaraan']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>

		<?php 
	}
	?>
</table>
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
</ul>

<!-- modal input -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_transaksi").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>