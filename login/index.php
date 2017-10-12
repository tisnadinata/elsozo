<?php
	
	include_once '../config/config_modul.php';
	include_once 'gpConfig.php';
	include_once 'User.php';
	if(isset($_GET['code'])){
		$gClient->authenticate($_GET['code']);
		// session_start();
		$_SESSION['token'] = $gClient->getAccessToken();
		header('Location: ' . filter_var($redirectURL."/google-callback.php", FILTER_SANITIZE_URL));
	}
	
	date_default_timezone_set('Asia/Jakarta');
	
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
								<li class="current"><a href="#" onclick="orderButton()" >Order Now</a></li>
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
								<b>Silahkan login untuk melakukan order atau konfirmasi pembayaran</b>
							  </div>
							  <div class="panel-body">
								<?php
									define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
									require_once __DIR__ . '/facebook-sdk-v5/autoload.php';
									$fb = new Facebook\Facebook([
									  'app_id' => "2006311336269832",
										'app_secret' => "e6273aef96d5a1a4ebe6d6ad426f3cdb",
									  'default_graph_version' => 'v2.10',
									  ]);

									$helper = $fb->getRedirectLoginHelper();

									$permissions = ['email',' publish_actions','user_posts']; // Optional permissions
									$_SESSION['loginUrl'] = $helper->getLoginUrl(getPengaturan("url_website")->value.'/login/fb-callback.php', $permissions);

									echo '<a href="'.$_SESSION['loginUrl'].'" id="login" ><img id="login_img" src="loginfacebook.png" class="btn-fb img-responsive"></a>';
										
								?>

								<center style="width:100%;font-style:bold;font-size:30px">ATAU</center>
							
								<?php
									$authUrl = $gClient->createAuthUrl();
									echo '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="logingoogle.png" class="img-responsive" alt=""/></a>';
								?>
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
