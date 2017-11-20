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
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from tb_bbm");
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
		$brg=mysql_query("select tb_bbm.no_transaksi,tb_bbm.no_kendaraan,tb_bbm.harga,tb_bbm.total,tb_bbm.volume,tb_bbm.stand_km,tb_bbm.sopir,tb_bbm.jenis_bbm,tb_bbm.lokasi_beli,tb_kendaraan.lokasi,
							DATE_FORMAT( tb_bbm.tgl_entry,  '%d-%m-%Y' ) AS tgl_entrybaru,
							DATE_FORMAT( tb_bbm.tgl_transaksi,  '%d-%m-%Y' ) AS tgl_transaksibaru
							from tb_bbm,tb_kendaraan where date_format(tb_bbm.tgl_transaksi,'%m-%Y') = '$blnth' and tb_bbm.no_kendaraan=tb_kendaraan.no_pol ");
	}else{
		$brg=mysql_query("select tb_bbm.no_transaksi,tb_bbm.no_kendaraan,tb_bbm.harga,tb_bbm.total,tb_bbm.volume,tb_bbm.stand_km,tb_bbm.sopir,tb_bbm.jenis_bbm,tb_bbm.lokasi_beli,tb_kendaraan.lokasi,
							DATE_FORMAT( tb_bbm.tgl_entry,  '%d-%m-%Y' ) AS tgl_entrybaru,
							DATE_FORMAT( tb_bbm.tgl_transaksi,  '%d-%m-%Y' ) AS tgl_transaksibaru  from tb_bbm,tb_kendaraan where tb_bbm.no_kendaraan=tb_kendaraan.no_pol order by tb_bbm.no_transaksi asc limit $start, $per_hal");
	}
	while($b=mysql_fetch_array($brg)){
	
		?>
		<tr>
			<td><?php echo $b['no_transaksi'] ?></td>
			<td><?php echo $b['tgl_entrybaru'] ?></td>
			<td><?php echo $b['no_kendaraan'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td>Rp.<?php echo number_format($b['total']) ?>,-</td>
			<td><?php echo $b['volume'] ?> L</td>
			<td><?php echo number_format($b['stand_km']) ?> KM</td>
			<td><?php echo $b['sopir'] ?></td>
			<td><?php echo $b['jenis_bbm'] ?></td>
			<td><?php echo $b['lokasi_beli'] ?></td>
			<td><?php echo $b['tgl_transaksibaru'] ?></td>
			<td>		
				<a href="edit_bbm.php?no_transaksi=<?php echo $b['no_transaksi']; ?>" class="btn btn-warning">Edit</a>
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
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data --- BBM
				</div>
				<div class="modal-body">				
					<form action="bbm_act.php" method="post">
					<input type="hidden" name="sopir" value="<?php echo $_SESSION['nama']?>">
						<div class="form-group">
							<label>No. Transaksi</label>
							<?php 
							// $query=mysql_query("SELECT max(no_transaksi) as noakhir FROM tb_bbm" );
							// while($c=mysql_fetch_array($query)){
							// $noakhir=$c['noakhir'];
							// $nobaru=$noakhir+1;
							// }
							$no_permohonan = "";
							$sql_sppd = "select no_permohonan from tb_sppd where nama_sopir = '".$_SESSION['nama']."'";
							$q_sppd = mysql_query($sql_sppd);
							if(mysql_num_rows($q_sppd)>0){
								$data_sppd = mysql_fetch_array($q_sppd);
								$no_permohonan = $data_sppd['no_permohonan'];

							}

							$sql_sewa = "select no_permohonan from tb_sewa where nama_sopir = '".$_SESSION['nama']."'";
							$q_sewa = mysql_query($sql_sewa);
							if(mysql_num_rows($q_sewa)>0){
								$data_sewa = mysql_fetch_array($q_sewa);
								$no_permohonan = $data_sewa['no_permohonan'];

							}


							?>
							<!-- <input name="no_transaksi" type="text" readonly class="form-control" id="no_transaksi" value="<?php //echo $nobaru ?>" autocomplete="off" > -->
							<input name="no_permohonan" type="text" readonly class="form-control" id="no_transaksi" value="<?php echo $no_permohonan?>" autocomplete="off" >
						</div>	
						
						<div class="form-group">
							<label>Tanggal Entry</label>
							<?php $tgl_entry=date('d-m-Y');
							echo $tgl_entry;?>
						</div>	
						<div class="form-group">
							<label>Nomor Kendaraan</label>								
							<?php
							$no_pol = "";
							$sql_sppd = "select no_pol from tb_sppd where nama_sopir = '".$_SESSION['nama']."'";
							$q_sppd = mysql_query($sql_sppd);
							if(mysql_num_rows($q_sppd)>0){
								$data_sppd = mysql_fetch_array($q_sppd);
								$no_pol = $data_sppd['no_pol'];

							}

							$sql_sewa = "select no_pol from tb_sewa where nama_sopir = '".$_SESSION['nama']."'";
							$q_sewa = mysql_query($sql_sewa);
							if(mysql_num_rows($q_sewa)>0){
								$data_sewa = mysql_fetch_array($q_sewa);
								$no_pol = $data_sewa['no_pol'];

							}

							/*
							<select class="form-control" name="no_kendaraan" >
								<?php 
								$brg=mysql_query("select * from tb_kendaraan");
								while($b=mysql_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['no_pol']; ?>"><?php echo $b['no_pol'] ?></option>
									<?php 
								}
								?>
							</select>
							*/
							?>
							<input type="text" name="no_kendaraan" value="<?php echo $no_pol?>" readonly class="form-control">


						</div>									
						<div class="form-group">
							<label>Harga Per Liter</label>
							<input name="harga" type="text" id="harga" class="form-control" placeholder="harga" required="required" autocomplete="off" onkeypress='return isNumberKeyTrue(event)' onPaste='false'>
						</div>	
						<div class="form-group">
							<label>Total Pembelian (Rupiah) </label>
							<input type="text" name="total" id="total" class="form-control" placeholder="total" required="required" autocomplete="off" onkeypress='return isNumberKeyTrue(event)' onPaste='false'>
						</div>	
						<div class="form-group">
							<label>Stand KM</label>
							<input name="stand_km" type="text" class="form-control" placeholder="stand km" required="required" autocomplete="off" onkeypress='return isNumberKeyTrue(event)' onPaste='false'>
						</div>	

						<?php
						/*
						<div class="form-group">
							<label>Sopir</label>								
							<select class="form-control" name="sopir">
								<?php 
								$brg=mysql_query("select * from tb_sopir");
								while($b=mysql_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['nama']; ?>"><?php echo $b['nama'] ?></option>
									<?php 
								}
								?>
							</select>

						</div>
						*/
						?>

						<div class="form-group">
							<label>Jenis BBM</label>
							<select class="form-control" name="jenis_bbm" onkeyup="this.value = this.value.toUpperCase()" required="required">
							  <option value="">Pilih Jenis BBM...</option>
							  <option value="premium">PREMIUM</option>
							  <option value="pertamax">PERTAMAX</option>
							  <option value="pertalite">PERTALITE</option>
							  <option value="solar">SOLAR</option>
							</select>
						</div>						
						
						<div class="form-group">
							<label>Lokasi Beli</label>
							<input name="lokasi_beli" type="text" class="form-control" placeholder="lokasi beli" required="required" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()">
						</div>
						<div class="form-group">
							<label> Tanggal Beli </label>
							<input name="tgl_transaksi" type="text" class="form-control" id="tgl_transaksi" required="required" autocomplete="off">
						</div>
				
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan">
						</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_transaksi").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>