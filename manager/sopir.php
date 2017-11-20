<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Sopir</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-3"><span class="glyphicon glyphicon-plus"></span>Tambah Data Sopir</button>
<br/>
<br/>


<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from tb_sopir");
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
</div>
<form action="cari_sopir.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari data sopir di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr bgcolor='#FFA800'>
		<th class="col-md-1">No</th>
		<th class="col-md-2">Nama</th>
		<th class="col-md-1">Tempat Tanggal Lahir</th>
		<th class="col-md-2">Jenis Kelamin</th>
		<th class="col-md-1">Jabatan</th>
		<th class="col-md-1">Nomor Kontak</th>
		<th class="col-md-5">Alamat</th>
		<th class="col-md-3">Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("select * from tb_sopir where nama like '%$cari%'");
	}else{
		$brg=mysql_query("select * from tb_sopir limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['ttl'] ?></td>
			<td><?php echo $b['jk'] ?></td>
			<td><?php echo $b['jabatan'] ?></td>
			<td><?php echo $b['no_hp'] ?></td>
			<td><?php echo $b['alamat'] ?></td>
			<td>
				<a href="det_sopir.php?nama=<?php echo $b['nama']; ?>" class="btn btn-info">Detail</a>
				<a href="edit_sopir.php?nama=<?php echo $b['nama']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_sopir.php?nama=<?php echo $b['nama']; ?>' }" class="btn btn-danger">Hapus</a>
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
				<h4 class="modal-title">Tambah Data Sopir Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_sopir.php" method="post">
					<div class="form-group">
						<label>Nama</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama Sopir .." onkeyup="this.value = this.value.toUpperCase()">
					</div>
					<div class="form-group">
						<label>Tempat Tanggal Lahir</label>
						<input name="ttl" type="text" class="form-control" placeholder="Tempat Tanggal Lahir / HH-BB-TTTT .." onkeyup="this.value = this.value.toUpperCase()">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<input name="jk" type="text" class="form-control" placeholder="Jenis Kelamin .." onkeyup="this.value = this.value.toUpperCase()">
					</div>	
					<div class="form-group">
						<label>Jabatan</label>
						<input name="jabatan" type="text" class="form-control" placeholder="Jabatan .." onkeyup="this.value = this.value.toUpperCase()">
					</div>	
					<div class="form-group">
						<label>Nomor Kontak</label>
						<input name="no_hp" type="text" class="form-control" placeholder="Kontak Sopir .." onkeyup="this.value = this.value.toUpperCase()">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input name="alamat" type="text" class="form-control" placeholder="Alamat Sopir.." onkeyup="this.value = this.value.toUpperCase()">
					</div>
					<div class="form-group">
						<label>Gaji Yang Diterima</label>
						<input name="gaji" type="number" class="form-control" placeholder="Alamat Sopir.." onkeyup="this.value = this.value.toUpperCase()">
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