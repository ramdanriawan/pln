<?php include 'header.php';	?>
<script>function isNumberKeyTrue(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 65)
            return false;        
         return true;
      }
	 </script>
<h3><span class="glyphicon glyphicon-briefcase"></span>  OVER TANK CHECK</h3>
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
<table class="table">
	<tr bgcolor='#FFA800'>
		<th>No. Transaksi</th>
		<th>Tanggal Beli</th>
		<th>No. Kendaraan</th>
		<th>Sopir</th>
		<th>Volume</th>
		<th>Kapasitas Tangki</th>		
		<th>Cek</th>	
		<th>Opsi</th>	
		
	</tr>
	
	<?php 
	if(isset($_GET['tanggal'])){
		$blnth=mysql_real_escape_string($_GET['tanggal']);
		$brg=mysql_query("select tb_bbm.no_transaksi,DATE_FORMAT( tb_bbm.tgl_transaksi,  '%d-%m-%Y' ) AS tgl_transaksibaru,tb_bbm.no_kendaraan,tb_bbm.sopir,tb_bbm.volume,tb_kendaraan.kapasitas_tangki from tb_bbm,tb_kendaraan where tb_bbm.no_kendaraan=tb_kendaraan.no_pol and date_format(tgl_transaksi,'%m-%Y') = '$blnth' and tb_bbm.volume>tb_kendaraan.kapasitas_tangki");
	}else{
		$brg=mysql_query("select DATE_FORMAT( tb_bbm.tgl_transaksi,  '%d-%m-%Y' ) AS tgl_transaksibaru,tb_bbm.no_transaksi,tb_bbm.no_kendaraan,tb_bbm.sopir,tb_bbm.volume,tb_kendaraan.kapasitas_tangki from tb_bbm,tb_kendaraan where tb_bbm.no_kendaraan=tb_kendaraan.no_pol and tb_bbm.volume>tb_kendaraan.kapasitas_tangki order by no_transaksi ");
	}
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $b['no_transaksi'] ?></td>
			<td><?php echo $b['tgl_transaksibaru'] ?></td>
			<td><?php echo $b['no_kendaraan'] ?></td>
			<td><?php echo $b['sopir'] ?></td>
			<td><?php echo $b['volume'] ?> L</td>
			<td><?php echo $b['kapasitas_tangki'] ?> L</td>
			<td><?php 
					if ($b['volume'] > $b['kapasitas_tangki']) 
					{
						$tes='OVER TANK';
						echo "<h5> <a style='color:red'> ". $tes."</a></h5>";
					}
					else 
					{
						echo "ON TANK";
					} ?></td>	
			<td>
				<a href="det_overtank.php?no_transaksi=<?php echo $b['no_transaksi']; ?>" class="btn btn-info">Detail</a>
			</td>
		</tr>

		<?php 
	}
	?>
</table>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_transaksi").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>