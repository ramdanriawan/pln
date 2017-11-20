<?php include 'header.php';	?>
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
<?php
$sql = "select count(*) as total from tb_kendaraan  where `status` = 'available'";
$q = mysql_query($sql);
$row = mysql_fetch_array($q);
$car_available = $row['total'];
?>
<div class=" table-responsive">
    
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
		<th>Status</th>
		<th>Type</th>
		<th>Car Available</th>
		<th>Action</th>
	</tr>
	
	<?php 
	$query=mysql_query("SELECT * from tb_permohonan where status = 'approved'");
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
			    <form class="" action="" method="post">
			        <select class='form-control' required>
			          <option value="">--Pilih Type Mobil--</option>
                      <?php 
                        $query = $pdo->query("select DISTINCT tipe from tb_kendaraan");
                        
                        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                            if($row->tipe == $b["type"])
                            {
                                $selected = "selected";
                            }else 
                            {
                                $selected = "";
                            }
                            
                            echo "<option value='$row->tipe' $selected>$row->tipe</option>";
                        }
                       ?>
			        </select>
			        
			    </form>
			</td>
            <td><?php echo $car_available?></td>

			
			<td>
			    <div class="button-group btn-grou-small">
			        <a class="btn btn-primary"href="monitor_permohonan_edit.php?media=edit&id=<?php echo $b['no_permohonan'];?>" name="button">
                        <span  class="glyphicon glyphicon-edit"></span>
                        Edit
                    </a>
			    </div>
                
			</td>
		</tr>

		<?php 
	}
	?>
</table>
</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_transaksi").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>