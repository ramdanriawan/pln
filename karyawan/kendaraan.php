<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Kendaraan</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-3"><span class="glyphicon glyphicon-plus"></span>Tambah Data Kendaraan</button>
<br/>
<br/>


<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from tb_kendaraan");
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
	<a style="margin-bottom:10px" href="lap_kendaraan.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
</div>
<form action="cari_kendaraan.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari data kendaraan di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr bgcolor='#FFA800'>
		<th class="col-md-1">No</th>
		<th class="col-md-1">Nomor Polisi</th>
		<th class="col-md-2">Merk</th>
		<th class="col-md-2">Tipe</th>
		<th class="col-md-1">Warna</th>
		<th class="col-md-2">Peruntukkan</th>
		<th class="col-md-1">Lokasi</th>
		<th class="col-md-1">Harga Sewa</th>
		<th class="col-md-3">Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("select * from tb_kendaraan where no_pol like '%$cari%' or tipe like '%$cari%'");
	}else{
		$brg=mysql_query("select * from tb_kendaraan limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['no_pol'] ?></td>
			<td><?php echo $b['merk'] ?></td>
			<td><?php echo $b['tipe'] ?></td>
			<td><?php echo $b['warna'] ?></td>
			<td><?php echo $b['peruntukkan'] ?></td>
			<td><?php echo $b['lokasi'] ?></td>
			<td>Rp.<?php echo number_format($b['hrg_sewa']) ?>,-</td>
			<td>
				<a href="det_kendaraan.php?no_pol=<?php echo $b['no_pol']; ?>" class="btn btn-info">Detail</a>
				<a href="edit.php?no_pol=<?php echo $b['no_pol']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_kendaraan.php?no_pol=<?php echo $b['no_pol']; ?>' }" class="btn btn-danger">Hapus</a>
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
				<h4 class="modal-title">Tambah Data Kendaraan Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_kendaraan.php" method="post">
					<div class="form-group">
						<label>Nomor Polisi</label>
						<input name="no_pol" type="text" class="form-control" placeholder="Nomor Polisi .." onkeyup="this.value = this.value.toUpperCase()">
					</div>
					<div class="form-group">
						<label>Merk</label>
						<input name="merk" type="text" class="form-control" placeholder="Merk Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>
					<div class="form-group">
						<label>Tipe</label>
						<input name="tipe" type="text" class="form-control" placeholder="Tipe Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>
					<div class="form-group">
						<label>Warna</label>
						<input name="warna" type="text" class="form-control" placeholder="Warna Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>
					<div class="form-group">
						<label>Peruntukkan</label>
						<input name="peruntukkan" type="text" class="form-control" placeholder="Kendaraan Untuk .." onkeyup="this.value = this.value.toUpperCase()">
					</div>	
					<div class="form-group">
						<label>Lokasi</label>
						<input name="lokasi" type="text" class="form-control" placeholder="Lokasi Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>	
					<div class="form-group">
						<label>Harga Sewa</label>
						<input name="hrg_sewa" type="text" class="form-control" placeholder="Harga Sewa Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>														
					<div class="form-group">
						<label>Nomor Rangka</label>
						<input name="no_rangka" type="text" class="form-control" placeholder="Nomor Rangka Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>	
					<div class="form-group">
						<label>Nomor Mesin</label>
						<input name="no_mesin" type="text" class="form-control" placeholder="Nomor Mesin Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>						
					<div class="form-group">
						<label>Bahan Bakar</label>
						<input name="bahan_bakar" type="text" class="form-control" placeholder="Bahan Bakar Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>																	
					<div class="form-group">
						<label>Kapasitas Tangki (L)</label>
						<input name="kapasitas_tangki" type="text" class="form-control" placeholder="Kapasitas Tangki Kendaraan .." >
					</div>																	
					<div class="form-group">
						<label>Tahun Kendaraan</label>
						<input name="tahun_kendaraan" type="text" class="form-control" placeholder="Tahun Kendaraan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>																	

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>



<?php 
include 'footer.php';

?>