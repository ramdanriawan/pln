<?php include 'header.php';	?>
<script>function isNumberKeyTrue(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 65)
            return false;        
         return true;
      }
	 </script>
<h3><span class="glyphicon glyphicon-print"></span>  SEWA</h3>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from tb_sewa ");
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
<br/>
<br/>
<table class="table">
	<tr bgcolor='#FFA800'>
		<th>No. Permohonan</th>
		<th>Nama Pemohon</th>
		<th>Driver</th>
		<th>Tanggal Pergi</th>
		<th>Tanggal Kembali</th>
		<th>Biaya Harian</th>				
		<th>Biaya Penginapan</th>		
		<th>Total</th>			
		<th>No Pol</th>
	</tr>
	
	<?php 
	$query=mysql_query("SELECT a.*, b.nama from tb_sewa a left join tb_permohonan b on a.no_permohonan = b.no_permohonan");
	if(mysql_num_rows($query)>0){
	while($b=mysql_fetch_array($query)){
	
		?>
		<tr>
			<td><?php echo $b['no_permohonan'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['driver'] ?></td>
			<td><?php echo $b['tanggal_pergi'] ?> orang</td>
			<td><?php echo $b['tanggal_kembali'] ?></td>
			<td><?php echo number_format($b['biaya_harian']) ?></td>
			<td><?php echo number_format($b['biaya_penginapan']) ?></td>
			<td><?php echo number_format($b['total']) ?></td>
			<td><?php echo $b['no_pol'] ?></td>
		</tr>

		<?php 
	}		
	}

	?>
</table>


	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_transaksi").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>