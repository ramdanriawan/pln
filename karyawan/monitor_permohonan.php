<?php include 'header3.php';	?>
<script>function isNumberKeyTrue(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 65)
            return false;        
         return true;
      }
	 </script>
<h3><span class="glyphicon glyphicon-print"></span>  CETAK PERMOHONAN PINJAM KENDARAAN DINAS</h3>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from tb_permohonan ");
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
		<th>Nama</th>
		<th>Bagian</th>
		<th>Jumlah Penumpang</th>
		<th>Hari & Tanggal Awal</th>
		<th>Hari & Tanggal Akhir</th>				
		<th>Jam Awal</th>		
		<th>Jam Akhir</th>			
		<th>Tujuan</th>
		<th>Keperluan</th>
		<th>Opsi</th>
	</tr>
	
	<?php 
	$query=mysql_query("SELECT * from tb_permohonan");
	while($b=mysql_fetch_array($query)){
	
		?>
		<tr>
			<td><?php echo $b['no_permohonan'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['bagian'] ?></td>
			<td><?php echo $b['jumlah_penumpang'] ?> orang</td>
			<td><?php echo $b['hari_tgl'] ?></td>
			<td><?php echo $b['hari_tglakhir'] ?></td>
			<td><?php echo $b['jam_awal'] ?></td>
			<td><?php echo $b['jam_akhir'] ?></td>
			<td><?php echo $b['tujuan'] ?></td>
			<td><?php echo $b['keperluan'] ?></td>
			<td>		
				<a href="print_permohonan.php?no_permohonan=<?php echo $b['no_permohonan']; ?>" class="btn btn-warning">CETAK</a>
				<a onclick="javascript:if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_permohonanmon.php?no_permohonan=<?php echo $b['no_permohonan']; ?>&nama=<?php echo $b['nama'] ?>&bagian=<?php echo $b['bagian']; ?>' }" class="btn btn-danger">Hapus</a>
				<a onclick="javascript:if(confirm('Apakah anda yakin ingin approve permohonan ini ??')){ location.href='setuju_permohonan.php?no_permohonan=<?php echo $b['no_permohonan']; ?>' }" class="btn btn-primary">Approve</a>
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