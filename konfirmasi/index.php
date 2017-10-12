<?php
	include_once '../config/config_modul.php';
	date_default_timezone_set('Asia/Jakarta');
	if(!isset($_SESSION['last_confirm'])){
		$_SESSION['last_confirm'] = date("Y-m-d H:i:s", strtotime(""));
	}
	if(!isset($_SESSION['login_id'])){
			header("location:".getPengaturan("url_website")->value."/login");
	}else{
		if($_SESSION['email'] == "" OR $_SESSION['telepon'] == "0"){
			header("location:".getPengaturan("url_website")->value."/login/emailtelepon.php");
		}
	}
	
	if(isset($_POST['orderKonfirmasi'])){
		$transaksi = explode("=",$_POST['invoice']);
		$metode_pembayaran = $_POST['metode'];
		$nama_bank = $_POST['nama_bank'];
		$pemilik_bank = $_POST['pemilik_bank'];
		$rekening_bank = $_POST['rekening_bank'];
		$total_dibayar = $_POST['total_dibayar'];
		$tanggal_dibayar = $_POST['tanggal_dibayar'];
		$upload_foto = upload_foto("../assets/bukti pembayaran/",$_FILES['bukti_pembayaran'],str_replace("-","_",$transaksi[1]));
		$upload_status = explode("-",$upload_foto);
		if($upload_status[0] == "true"){
			$path = str_replace("..",getPengaturan("url_website")->value,$upload_status[1]);
			$sql_confirm = "update tbl_transaksi_pembayaran set metode_pembayaran='$metode_pembayaran',nama_bank='$nama_bank',pemilik_bank='$pemilik_bank',rekening_bank='$rekening_bank',
			total_dibayar='$total_dibayar',tanggal_dibayar='$tanggal_dibayar',bukti_pembayaran='$path' where id_transaksi=".$transaksi[0];
			$stmt = $mysqli->query($sql_confirm);
			if($stmt){
				$mysqli->query("update tbl_transaksi set status_transaksi='confirmed' where id_transaksi=".$transaksi[0]);
				$_SESSION['last_confirm'] = date("Y-m-d H:i:s");
				echo'
					<div class="alert alert-success" role="alert">
						<center>TRANSAKSI DENGAN INVOICE '.$transaksi[1].' TELAH BERHASIL DIKONFIRMASI DAN AKAN KAMI VERIFIKASI</center>
					</div>
				';
			}else{
				echo'
					<div class="alert alert-danger" role="alert">
						<center>TRANSAKSI DENGAN INVOICE '.$transaksi[1].' TIDAK DAPAT DIKONFIRMASI, SILAHKAN COBA LAGI NANTI</center>
					</div>
				';
			}
		}else{
			echo'
				<div class="alert alert-danger" role="alert">
					<center>GAGAL MENGUPLOAD FOTO, '.$upload_status[1].'</center>
				</div>
			';
		}
	}
?>
<html lang="en">
	<head>
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../images/logo_icon.ico">
		<!-- Page Title -->
		<title><?php echo getPengaturan("title_website")->value;?></title>
		
		<!-- Icon fonts -->
		<link href="../css/font-awesome.min.css" rel="stylesheet">
		<link href="../css/flaticon.css" rel="stylesheet">
		
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Plugins for this template -->
		<link href="../css/animate.css" rel="stylesheet">
		<link href="../css/owl.carousel.css" rel="stylesheet">
		<link href="../css/owl.theme.css" rel="stylesheet">
		<link href="../css/owl.transitions.css" rel="stylesheet">
		<link href="../css/jquery.fancybox.css" rel="stylesheet">
		<link href="../css/bootstrap-select.css" rel="stylesheet">
		<link href="../css/magnific-popup.css" rel="stylesheet">
		
		<!-- Custom styles for this template -->
		<link href="../css/style.css" rel="stylesheet">
		<script type="text/javascript">
			function landingButton(){
				window.location.href = "<?php echo getPengaturan("url_website")->value;?>";
			}
			function orderButton(){
				window.location.href = "<?php echo getPengaturan("url_website")->value;?>/order";
			}
		</script>
	</head>
	
	<body class="trx">
		
		<!-- start page-wrapper -->
		<div class="page-wrapper" id="home">
			
			<!-- start preloader -->
			<div class="preloader">
				<div>
					<img src="images/pre-loader.gif" alt>
				</div>
			</div>
			<!-- end preloader -->
			
			<!-- Start header -->
			<header class="site-header">
				<nav class="navigation navbar navbar-default">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="open-btn">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#"><img src="../images/logo.png" alt class="img img-responsive"></a>
						</div>
						<div id="navbar" class="navbar-collapse collapse navbar-right">
							<button class="close-navbar"><i class="fa fa-close"></i></button>
							<ul class="nav navbar-nav">
								<li><a href="#" onclick="landingButton()">Overview</a></li>
								<li><a href="#" onclick="landingButton()">Product</a></li>
								<li><a href="#" onclick="landingButton()">Article</a></li>
								<li><a href="#" onclick="landingButton()">Contact</a></li>
								<li class="current"><a href="#"  onclick="orderButton()" >Order Now</a></li>
							</ul'
						</div><!-- end of nav-collapse -->
					</div><!-- end of container -->
				</nav>
			</header>
			<!-- end of header -->
			<!-- start product-->
			<section class="faq section-padding" id="product">
				<div class="container">
					<div class="col-md-12" style="margin-top:10%">
						<div class="col-md-8 col-lg-offset-2">
							<div class="panel panel-success">
							  <div class="panel-heading">
								<b>Konfirmasi Pembayaran Transaksi</b>
							  </div>
							  <div class="panel-body">
								<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
									<div class="form-group">
									  <label class="col-md-4 control-label">NOMOR INVOICE</label>
									  <div class="col-md-8">
										<select class="form-control" name="invoice">
										  <option>Pilih Transaksi</option>
										  <?php
											$listTransaksi = $mysqli->query("select * from tbl_transaksi where status_transaksi='pending' and id_users = ".$_SESSION['login_id']." group by invoice order by id_transaksi DESC");
											while($getTransaksi = $listTransaksi->fetch_object()){
												?>
													<option value="<?php echo $getTransaksi->id_transaksi."=".$getTransaksi->invoice;?>"><?php echo $getTransaksi->invoice;?></option>		
												<?php
											}
										?>     
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label">METODE PEMBAYARAN</label>
									  <div class="col-md-8">
										<select class="form-control" name="metode">
										  <option>BANK TRANSFER</option>
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label">NAMA BANK</label>
									  <div class="col-md-8" >
										<input type="text" name="nama_bank" class="form-control" required>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label">PEMILIK REKENING</label>
									  <div class="col-md-8" >
										<input type="text" name="pemilik_bank" class="form-control" required>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label">NOMOR REKENING</label>
									  <div class="col-md-8" >
										<input type="number" name="rekening_bank" class="form-control" required>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label">TANGGAL PEMBAYARAN</label>
									  <div class="col-md-8" >
										<input type="date" name="tanggal_dibayar" class="form-control" required>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label">TOTAL DIBAYARKAN</label>
									  <div class="col-md-8" >
										<input type="number" name="total_dibayar" class="form-control" required>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label">BUKTI PEMBAYARAN</label>
									  <div class="col-md-8" >
										<input type="file" name="bukti_pembayaran" class="form-control" required>
									  </div>
									</div>
									<?php
										$awal  = date_create($_SESSION['last_confirm']);
										$akhir = date_create(); // waktu sekarang
										$diff  = date_diff( $awal, $akhir );
										if($diff->i > 10){
											echo'<button type="submit" class="btn btn-success btn-sm pull-right" name="orderKonfirmasi" >Konfirmasi Pembayaran <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>';
										}else{
											echo "<div class='alert alert-warning col-md-12' role='alert'>Untuk menghindari spam, konfirmasi pembayaran hanya dapat dilakukan 10 menit sekali. Terakhir konfirmasi pada ".date("H:i:s",strtotime($_SESSION['last_confirm']))."</div>";
											echo'<a class="btn btn-success btn-sm pull-right" disabled>Konfirmasi Pembayaran <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>';
										}
									?>
								</form>
							  </div>
							</div>
						</div>
					</div>
				</div> <!-- end container -->
			</section>
			<!-- end product-->
			
			<?php
				include "../footer.php";
			?>
		</div>
		<!-- end of page-wrapper -->
	</div>
	
	<!-- All JavaScript files
	================================================== -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	
	<!-- Plugins for this template -->
	<script src="../js/jquery-plugin-collection.js"></script>
	
	<!-- Custom script for this template -->
	<script src="../js/script.js"></script>
</body>
</html>
