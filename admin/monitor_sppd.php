<?php include 'header.php';	?>
<script>function isNumberKeyTrue(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 65)
            return false;        
         return true;
      }
	 </script>
<h3><span class="glyphicon glyphicon-print"></span>  Data Trip</h3>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from tb_sppd ");
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
		<th>Jumlah Hari</th>
		<th>Biaya Harian</th>
		<th>Biaya Penginapan</th>
		<th>Total</th>
		
		<th>No Pol</th>
		<th>Opsi</th>
	</tr>
	
	<?php 
	$query=mysql_query("SELECT a.*, b.nama from tb_sppd a left join tb_permohonan b on a.no_permohonan = b.no_permohonan");
	if(mysql_num_rows($query)>0){
	while($b=mysql_fetch_array($query)){

	?>
	<tr>
	<td><?php echo $b['no_permohonan'] ?></td>
	<td><?php echo $b['nama'] ?></td>
	<td><?php echo $b['nama_sopir'] ?></td>


	<td><?php echo $b['tanggal_awal'] ?></td>
	<td><?php echo $b['tanggal_akhir'] ?></td>
	<td><?php echo $b['jumlah_hari'] ?></td>
	<td><?php echo $b['biaya_harian'] ?></td>
	<td><?php echo $b['biaya_penginapan'] ?></td>
	<td><?php echo $b['total_biaya'] ?></td>



	<td><?php echo $b['no_pol'] ?></td>
	<td><a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_sppd.php?id_sppd=<?php echo $b['id_sppd']; ?>' }" class="btn btn-danger">Hapus</a></td>
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