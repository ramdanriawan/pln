<!DOCTYPE html>
<html>
<head>
	<?php 
	session_start();
	include 'config.php';
	?>
	<title>PT PLN AP2B SISTEM KALSELTENG</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
	<script src="jquery.mobile-1.4.5.js"></script>	
		<script src="jquery.mobile-1.4.5.min.js"></script>
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
							<span style="font-size:smaller;">You are logged in as Admin</span>
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
			$use=@$_SESSION['username'];
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
			<li class="active"><a href="index2.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>			
			<li><a href="monitor_permohonan.php"><span class="glyphicon glyphicon-briefcase"></span>  Permohonan</a></li>
			<li><a href="monitor_mobil.php"><span class="glyphicon glyphicon-briefcase"></span>  Mobil</a></li>
			<li><a href="monitor_sppd.php"><span class="glyphicon glyphicon-briefcase"></span>  SPPD</a></li>
			<!-- <li><a href="form_permohonan.php"><span class="glyphicon glyphicon-briefcase"></span>  Form Permohonan</a></li> -->
			<li><a href="cetak_permohonan.php"><span class="glyphicon glyphicon-print"></span> Cetak Permohonan</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>				
				
		</ul>
	</div>
	<div class="col-md-10">