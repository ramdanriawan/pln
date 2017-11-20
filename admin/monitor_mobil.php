<?php include 'header.php';	?>
<script>function isNumberKeyTrue(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 65)
            return false;        
         return true;
      }
	 </script>
<h3><span class="glyphicon glyphicon-print"></span>  CETAK MOBIL</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-3"><span class="glyphicon glyphicon-plus"></span>Tambah Data Kendaraan</button>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from tb_kendaraan ");
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
		<th>No. Kendaraan</th>
		<th>Nama Mobil</th>	
		<th>Driver</th>
		<th>Tujuan</th>
		<th>Status</th>
	</tr>
	
	<?php 
	$sql = "SELECT a.*,
	 		(CASE b.type 
	 		WHEN 'sppd_yes' THEN  (SELECT nama_sopir from tb_sppd where no_pol = a.no_pol)
			WHEN 'mobil_op' THEN  (SELECT nama_sopir from tb_sppd where no_pol = a.no_pol)
			WHEN 'sewa' THEN  (SELECT nama_sopir from tb_sewa where no_pol = a.no_pol)
			END) as nama_sopir,
	 (CASE b.end 
		WHEN '0' THEN  (SELECT b.tujuan from tb_permohonan where no_pol = a.no_pol)
		ELSE ''
		END)  as tujuan,
		b.end

		from tb_kendaraan a left join tb_permohonan b on a.no_pol = b.no_pol ";
		//echo $sql;
	$query=mysql_query($sql);
	while($b=mysql_fetch_array($query)){
	
		?>
		<tr>
			<td><?php echo $b['no_pol'] ?></td>
			<td><?php echo $b['tipe'] ?></td>
			<td><?php echo $b['end']=="0" ? $b['nama_sopir'] : ''  ?></td>
			<td><?php echo $b['tujuan'] ?></td>
			<td><?php echo $b['status'] ?></td>
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