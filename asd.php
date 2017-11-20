<?php include 'header3.php';	?>

<h3><span class="glyphicon glyphicon-print"></span>  CETAK PERMOHONAN PINJAM KENDARAAN DINAS</h3>

<div class="col-md-12">
<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="nama_driver">Nama Driver:</label>
    <input type="text" class="form-control" id="nama_driver">
  </div>
  <div class="form-group">
    <label for="tanggal_pergi">Tanggal Pergi:</label>
    <input type="text" class="form-control" id="tanggal_pergi">
  </div>
  <div class="form-group">
    <label for="tanggal_kembali">Tanggal Kembali:</label>
    <input type="text" class="form-control" id="tanggal_kembali">
  </div>

  <div class="form-group">
    <label for="biaya_harian">Biaya Harian:</label>
    <input type="text" class="form-control" id="biaya_harian">
  </div>  
  <div class="form-group">
    <label for="biaya_penginapan">Biaya Penginapan:</label>
    <input type="text" class="form-control" id="biaya_penginapan">
  </div>  
  <div class="form-group">
    <label for="total">Total:</label>
    <input type="password" class="form-control" id="total">
  </div>  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>

	<?php include 'footer.php'; ?>