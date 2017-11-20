<?php include "header.php" ?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<form action="" method="post">
				<?php 
				$query = $pdo->query("select * from tb_permohonan where no_permohonan='$_GET[id]'")->fetch(PDO::FETCH_OBJ);

				//print_r($query);		
				 ?>
				 
				 <div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label>
								Nama:
								<input class="form-control capitalize" type="" name="nama" placeholder="Nama" value="<?php echo $query->nama;?>">
							</label>
						</div>
						<div class="form-group">
							<label>
								Bagian:
								<input class="form-control" type="" name="bagian" placeholder="Bagian" value="<?php echo $query->bagian;?>">
							</label>
						</div>
						<div class="form-group">
							<label>
								Jumlah Penumpan:
								<input class="form-control" type="number" name="jumlah_penumpang" placeholder="Jumlah Penumpang" value="<?php echo $query->jumlah_penumpang;?>" min="0">
							</label>
						</div>
						<div class="form-group">
							<label>
								Hari Tanggal Awal:
								<input class="form-control tanggal_akhir" type="" name="hari_tgl" placeholder="Hari Tgl" value="<?php echo $query->hari_tgl;?>">
							</label>
						</div>
						<div class="form-group">
							<label>
								Hari Tanggal Akhir:
								<input class="form-control tanggal_awal" type="" name="hari_tglakhir" placeholder="Hari Tgl Akhir" value="<?php echo $query->hari_tglakhir;?>">
							</label>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label>
								Jam Awal:
								<input class="form-control timepicker" type="" name="jam_awal" placeholder="Jam Awal" value="<?php echo $query->jam_awal;?>">
							</label>
						</div>
						<div class="form-group">
							<label>
								Jam Akhir:
								<input class="form-control timepicker" type="" name="jam_akhir" placeholder="Jam Akhir" value="<?php echo $query->jam_akhir;?>">
							</label>
						</div>
						<div class="form-group">
							<label>
								Tujuan:
								<input class="form-control" type="" name="tujuan" placeholder="Tujuan" value="<?php echo $query->tujuan;?>">
							</label>
						</div>
						<div class="form-group">
							<label>
								Keperluan:
								<input class="form-control" type="" name="keperluan" placeholder="Keperluan" value="<?php echo $query->keperluan;?>">
							</label>
						</div>
						
						
						<div class="form-group">
							<select class="form-control" name="status" required>
								<option value="">--Status--</option>
								<?php 
								$query_select = $pdo->query("select * from tb_status");
								
								while ($row = $query_select->fetch(PDO::FETCH_OBJ)) {
									
									if($row->status == $query->status)
									{
										$selected = "selected";
									}else
									{
										$selected = "";
									}
									
									echo "<option value='$row->status' $selected>$row->status</option>";
								}
								?>
							</select>
						</div>
						
					</div>
				</div>
			</div>
				 
				 <input type="hidden" name="table" value="tb_permohonan">
				 
				 <div class="row">
				   <div class="col-md-5">
				     <div class="form-group">
						 <button type="submit" class="btn btn-primary btn-block">
						 	<span class="glyphicon glyphicon-saved"></span>
							 Save
						 </button>
				     </div>
				   </div>
				   <div class="col-md-5">
				     <div class="form-group">
						 <button type="reset" class="btn btn-warning btn-block">
						 	<span class="glyphicon glyphicon-refresh"></span>
							 Reset
						 </button>
				     </div>
				   </div>
				 </div>
			</form>
		</div>
	</div>
</div>


<?php include "footer.php" ?>

<?php 

if($_POST["table"])
{
	foreach ($_POST as $key => $value)
	{
		$_POST["$key"] = addslashes($_POST["$key"]);
	}
	
	$query = $pdo->query("update tb_permohonan set 
		nama                = '$_POST[nama]', 
		bagian              = '$_POST[bagian]', 
		jumlah_penumpang    = '$_POST[jumlah_penumpang]', 
		hari_tgl            = '$_POST[hari_tgl]', 
		hari_tglakhir       = '$_POST[hari_tglakhir]', 
		jam_awal            = '$_POST[jam_awal]',
		jam_akhir           = '$_POST[jam_akhir]',
		tujuan              = '$_POST[tujuan]', 
		keperluan           = '$_POST[keperluan]',
		tglcetak_permohonan = '$_POST[tglcetak_permohonan]', 
		menyetujui          = '$_POST[menyetujui]',
		mengetahui          = '$_POST[mengetahui]',
		pemohon             = '$_POST[pemohon]', 
		no_pol              = '$_POST[no_pol]',
		driver              = '$_POST[driver]', 
		status              = '$_POST[status]', 
		type                = '$_POST[type]',
		end                 = '$_POST[end]'
		
		where 
		
		no_permohonan       = '$_GET[id]'
	");
	
	if($query)
	{
		alert("Berhasil Mengupdate Data Permohonan  Dengan Id $_GET[id]");
		location("monitor_permohonan.php");
	}else 
	{
		alert("Gagal Mengupdate Data Permohonan Dengan Id $_GET[id], error: " . print_r($pdo->errorInfo()) );
	}
	
}

 ?>