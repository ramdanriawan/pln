<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-print"></span>  INPUT SPPD</h3>

<div class="col-md-12">
<form class="form-horizontal" action="simpan_sppd.php" method="post">
  <input type="hidden" name="no_permohonan" value="<?php echo $_GET['no_permohonan']?>">

  <div class="form-group">
    <label for="driver">Nama Driver:</label>
    <select name="driver" class="form-control">
      <?php
      $sql = "select * from tb_sopir order by nama asc";
      $q = mysql_query($sql);
      while($data = mysql_fetch_array($q)){
        ?>
        <option value="<?php echo $data['nama']?>"><?php echo $data['nama']?></option>
        <?php
      }
      ?>
    </select>
  </div>
  <?php
  $q = mysql_query("select * from tb_permohonan where no_permohonan = ".$_GET['no_permohonan']) or die("Error select * from tb_permohonan where no_permohonan = ".$_GET['no_permohonan']);
  $data = mysql_fetch_array($q);
  ?>
  <div class="form-group">
    <label for="tanggal_pergi">Tanggal Pergi:</label>
    <input type="text" class="form-control" id="tanggal_pergi" name="tanggal_pergi" value="<?php echo $data['hari_tgl']?>">
  </div>
  <div class="form-group">
    <label for="tanggal_kembali">Tanggal Kembali:</label>
    <input type="text" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="<?php echo $data['hari_tglakhir']?>">
  </div>

  <div class="form-group">
    <label for="biaya_harian">Biaya Harian:</label>
    <input type="text" class="form-control number" id="biaya_harian" name="biaya_harian">
  </div>  
  <div class="form-group">
    <label for="biaya_penginapan">Biaya Penginapan:</label>
    <input type="text" class="form-control number" id="biaya_penginapan" name="biaya_penginapan">
  </div>  
  <div class="form-group">
    <label for="total">Total:</label>
    <input type="text" class="form-control" id="total" name="total" readonly="readonly">
  </div>  
  <div class="form-group">
    <label for="nama_mobil">Nama Mobil:</label>
    <select name="no_pol" class="form-control">
      <?php
      $sql = "select * from tb_kendaraan where status != 'in use' order by no_pol asc";
      echo $sql;
      $q = mysql_query($sql);
      while($data = mysql_fetch_array($q)){
        ?>
        <option value="<?php echo $data['no_pol']?>"><?php echo $data['no_pol']?> - <?php echo $data['tipe']?></option>
        <?php
      }
      ?>
    </select>  </div>  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>

<script type="text/javascript" src="../assets/js/jquery-1.7.2.js"></script>
  <script type="text/javascript" src="../assets/ui/jquery.ui.core.js"></script>
  <script type="text/javascript" src="../assets/ui/jquery.ui.datepicker.js"></script>
  <script type="text/javascript" src="../assets/ui/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript">

$(document).ready(function(){

  $("#tanggal_pergi,#tanggal_kembali").datepicker({

  dateFormat: "DD, dd MM yy",showOn: "button",
  buttonImage: "../assets/img/cal.gif",
  buttonImageOnly: true

  });

  $("#biaya_harian,#biaya_penginapan").change(function(){
    var biaya_harian = $("#biaya_harian").val();
    var biaya_penginapan = $("#biaya_penginapan").val();
    var total = 0;
    if(biaya_harian!="" && biaya_penginapan!=""){
      if(isNaN(biaya_harian)==false && isNaN(biaya_penginapan)==false){
        total = parseInt(biaya_harian) + parseInt(biaya_penginapan);
        $("#total").val(total);
      }

    }
    var total = biaya_penginapan + biaya_harian;
  });

    $(".number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

</script>

<link rel="stylesheet" media="all" type="text/css" href="../assets/ui/jquery-date-time-picker/jquery-ui.css" />
 <link rel="stylesheet" media="all" type="text/css" href="../assets/ui/jquery-date-time-picker/jquery-ui-timepicker-addon.css" />
 <script type="text/javascript" src="../assets/ui/jquery-date-time-picker/jquery-ui-timepicker-addon.js"></script>
 <script type="text/javascript" src="../assets/ui/jquery-date-time-picker/jquery-ui-sliderAccess.js"></script>
  <script>
  
 $('#jamawal,#jamakhir').timepicker({
 timeFormat: 'HH:mm:ss',
 stepHour: 1,
 stepMinute: 1,
 stepSecond: 1,
 });
  </script>

<?php include 'footer.php'; ?>