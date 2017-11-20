<?php include 'header.php';	?>
<script>function isNumberKeyTrue(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 65)
            return false;        
         return true;
      }
	 </script>
<?php 
$per_hal       = 20;
$jumlah_record = mysql_query("SELECT COUNT(*) from tb_permohonan ");
$jum           = mysql_result($jumlah_record, 0);
$halaman       = ceil($jum / $per_hal);
$page          = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start         = ($page - 1) * $per_hal;
?>

<div class="col-md-12 ">
    <?php  download_excel("tb_permohonan", ""); ?> <?php filter(); ?>
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
<table class="table filter_data">
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
		<th>Status</th>
		<th>Opsi</th>
		<th>Action</th>
	</tr>
	
	<?php 
	$query=mysql_query("SELECT * from tb_permohonan limit $start,$per_hal");
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
			<td><?php echo $b['status'] ?></td>
			<td>		
				<a href="print_permohonan.php?no_permohonan=<?php echo $b['no_permohonan']; ?>" class="btn btn-warning btn-xs">CETAK</a>
				<!-- <a onclick="javascript:if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_permohonanmon.php?no_permohonan=<?php //echo $b['no_permohonan']; ?>&nama=<?php //echo $b['nama'] ?>&bagian=<?php //echo $b['bagian']; ?>' }" class="btn btn-danger btn-xs">Hapus</a> -->
				<?php
				if($b['status']!="approved"){
					if($b['status']=="rejected"){
						?>
					<a onclick="javascript:if(confirm('Apakah anda yakin ingin approve permohonan ini ??')){ location.href='setuju_permohonan.php?no_permohonan=<?php echo $b['no_permohonan']; ?>' }" class="btn btn-primary btn-xs">Approve</a>

						<?php

					}
					else{
						?>
					<a onclick="javascript:if(confirm('Apakah anda yakin ingin approve permohonan ini ??')){ location.href='setuju_permohonan.php?no_permohonan=<?php echo $b['no_permohonan']; ?>' }" class="btn btn-primary btn-xs">Approve</a>
					<a onclick="javascript:if(confirm('Apakah anda yakin ingin reject permohonan ini ??')){ location.href='tolak_permohonan.php?no_permohonan=<?php echo $b['no_permohonan']; ?>' }" class="btn btn-primary btn-xs">Reject</a>

						<?php

					}
					?>
					<?php
				}
				?>
				
			</td>
			<td>
				<div class="btn-group">
					<a class="btn btn-primary" href="monitor_permohonan_edit.php?media=edit&id=<?php echo $b["no_permohonan"]; ?>">
						<span class="glyphicon glyphicon-edit"></span>
						 Edit
					</a>
				</div>
			</td>
		</tr>

		<?php 
	}
	?>
</table>
<?php $procedural->pagination("monitor_permohonan.php", "tb_permohonan") ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_transaksi").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>