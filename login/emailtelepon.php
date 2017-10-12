<?php
	include_once '../config/config_modul.php';
	date_default_timezone_set('Asia/Jakarta');
	if(!isset($_SESSION['login_id'])){
			header("location:".getPengaturan("url_website")->value."/login");
	}
	
	if(isset($_POST['editProfile'])){
		$email = $_POST['email'];
		$telepon = $_POST['telepon'];
		$sql_confirm = "update tbl_users set email='$email',telepon='$telepon' where id_users=".$_SESSION['login_id'];
		$stmt = $mysqli->query($sql_confirm);
		if($stmt){
			$_SESSION['telepon'] = $telepon;
			$_SESSION['email'] = $email;
			echo'
				<div class="alert alert-success" role="alert">
					<center>Data anda berhasil diubah</center>
				</div>
			';
			echo '<meta http-equiv="refresh" content="2; url=../order" />';
		}else{
			echo'
				<div class="alert alert-danger" role="alert">
					<center>Data gagal diubah, silahkan coba lagi</center>
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
		
		<!-- Page Title -->
		<title>Elsozo</title>
		
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
								<b>Edit Data Profile</b>
							  </div>
							  <div class="panel-body">
								<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
									<div class="form-group">
									  <label class="col-md-4 control-label">EMAIL AKTIF</label>
									  <div class="col-md-8" >
										<input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" required>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label">TELEPON AKTIF</label>
									  <div class="col-md-8" >
										<input type="text" name="telepon" class="form-control" value="<?php echo $_SESSION['telepon']; ?>" required>
									  </div>
									</div>
									<button type="submit" class="btn btn-success btn-sm pull-right" name="editProfile" >Perbaharui data saya <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
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
