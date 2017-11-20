<?php include "../koneksi/koneksi.php" ?>
<?php include "../helpers/helper_helper.php" ?>
<?php include "../libraries/Procedural.php" ?>
<?php $procedural = new Procedural(); ?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	session_start();
	 error_reporting(0);
	include 'config.php';
	?>
	<title>PT PLN AP2B SISTEM KALSELTENG</title>

	<!-- by ramdan riawan -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/jquery-ui/jquery-ui.min.js"></script>
	<!-- <script src="../node_modules/timepicker/timepicker.min.js" charset="utf-8"></script> -->
    <script src="../node_modules/number/number.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../js/default.js"></script>
    <script src="../js/script.js"></script>

    <link rel="stylesheet" type="text/css" href="../node_modules/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="../node_modules/timepicker/timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="../node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- end by ramdan riawan -->

	
	<script type="text/javascript" src="../assets/js/jquery-1.7.2.js"></script>
	<script type="text/javascript" src="../assets/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="../assets/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="../assets/ui/jquery.ui.datepicker-id.js"></script>
	<script type="text/javascript" src="../assets/ui/jquery-date-time-picker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="../assets/ui/jquery-date-time-picker/jquery-ui-sliderAccess.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" media="all" type="text/css" href="../assets/ui/jquery-date-time-picker/jquery-ui.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../assets/ui/jquery-date-time-picker/jquery-ui-timepicker-addon.css" />

</head>
<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="http://www.pln.co.id/kalselteng/?p=62" class="navbar-brand">PT PLN (Persero) AP2B SISTEM KALSELTENG</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">				
				<ul class="nav navbar-nav navbar-right">
					<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan</a></li>
					<li>
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Hy , <?php echo @$_SESSION['username']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span>
							<br/>
							<span style="font-size:smaller;">You are logged in as Manager</span>
						</a>
						
						
					</li>					
				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	

	<div class="col-md-2">
		<div class="row">
			<?php 
			$use=$_SESSION['username'];
			$fo=mysql_query("select foto from tb_login where username='$use'");
			while($f=mysql_fetch_array($fo)){
				?>				

				<div class="col-xs-6 col-md-12">
					<a class="thumbnail">
						<img class="img-responsive" src="foto/<?php echo $f['foto']; ?>">
					</a>
				</div>
				<?php 
			}
			?>		
		</div>

		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="index3.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>			
			<li><a href="monitor_permohonan.php"><span class="glyphicon glyphicon-briefcase"></span>  Permohonan Pinjam Kendaraan Dinas</a></li>
			<li><a href="monitor_sppd.php"><span class="glyphicon glyphicon-briefcase"></span>  Data Trip</a></li>
			<li><a href="monitor_sewa.php"><span class="glyphicon glyphicon-briefcase"></span>  Sewa</a></li>
			<li><a href="monitor_bbm.php"><span class="glyphicon glyphicon-print"></span> Pengendalian BBM</a></li>
			<li><a href="overtank2.php"><span class="glyphicon glyphicon-check"></span> OVER TANK CHECK  </a></li>
			<li><a href="#"><span class="glyphicon glyphicon-check"></span> OFF DATE CHECK  </a></li>  
			<li><a href="#"><span class="glyphicon glyphicon-check"></span> OFF ROUTE CHECK  </a></li> 
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>				
				
		</ul>
	</div>
	<div class="col-md-10">