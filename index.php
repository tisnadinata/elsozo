<?php
	include_once "config/config_modul.php";
?>
<html lang="en">
	<head>
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="">
		<link rel="shortcut icon" href="images/logo_icon.ico">
		
		<!-- Page Title -->
		<title><?php echo getPengaturan("title_website")->value;?></title>
		
		<!-- Icon fonts -->
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/flaticon.css" rel="stylesheet">
		
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Plugins for this template -->
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/owl.carousel.css" rel="stylesheet">
		<link href="css/owl.theme.css" rel="stylesheet">
		<link href="css/owl.transitions.css" rel="stylesheet">
		<link href="css/jquery.fancybox.css" rel="stylesheet">
		<link href="css/bootstrap-select.css" rel="stylesheet">
		<link href="css/magnific-popup.css" rel="stylesheet">
		
		<!-- Custom styles for this template -->
		<link href="css/style.css" rel="stylesheet">
		<script type="text/javascript">
			function orderButton(){
				window.location.href = "<?php echo getPengaturan("url_website")->value;?>/order";
			}
		</script>
		
	</head>
	
	<body> 
		
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
							<a class="navbar-brand" href="#"><img src="images/logo.png" alt class="img img-responsive"></a>
						</div>
						<div id="navbar" class="navbar-collapse collapse navbar-right">
							<button class="close-navbar"><i class="fa fa-close"></i></button>
							<ul class="nav navbar-nav">
								<li><a href="#home">Overview</a></li>
								<li><a href="#product">Product</a></li>
								<li><a href="#article">Article</a></li>
								<li><a href="#contact">Contact</a></li>
								<li class="current"><a href="#"  onclick="orderButton()">Order Now</a></li>
							</ul'
						</div><!-- end of nav-collapse -->
					</div><!-- end of container -->
				</nav>
			</header>
			<!-- end of header -->
			
			
			<!-- start of hero -->   
			<section class="hero-slider-wrapper">
				<div class="hero-slider home1-hero-slider">
					<div class="slide">
						<img src="images/home1-slider/slider-1.jpg" alt class="slider-bg">
						<div class="container">
							<div class="row">
								<div class="col col-xs-12 slide-caption">
									<span><img src="images/logo_besar.png"></span>
									<h1>Helm jadi Fresh, Wangi, Dan Nyaman</h1>
									<p style="font-family:'Arial Black'">Katakan Tidak pada Bau dan Gatal </p>
									<a href="#" class="btn theme-btn" style="font-family:'Arial Black'">Order Now</a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="slide">
						<img src="images/home1-slider/slider-1.jpg" alt class="slider-bg">
						<div class="container">
							<div class="row">
								<div class="col col-xs-12 slide-caption">
									<span><img src="images/logo_besar.png"></span>
									<h1>Formula Aegis-USA</h1>
									<p style="font-family:'Arial Black'">Tetap Fresh dan Higienis</p>
									<a href="#" class="btn theme-btn" style="font-family:'Arial Black'">Order Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- end of hero slider -->
			
			
			<!-- start product-->
			<section class="faq section-padding" id="product">
				<div class="container">

						<div class="col col-md-12 left-col">
							
							<div class="inner">
								
								<img src="images/faq/faq-video-poster.png" class="img-responsive video-product-image" >
								<iframe class="video-product" src="https://www.youtube.com/embed/kE0ccVyWzbg?ecver=1&autoplay=0" allowfullscreen ></iframe>
								
							</div>
						</div>
					</div> <!-- end row -->
					<!--
					<div class="row">
						<div class="watch-more"><a href="https://www.youtube.com/watch?v=6CIQCRu9Xo4" target="_blank">Watch More</a></div>
					</div>
					-->
				</div> <!-- end container -->
			</section>
			<!-- end product-->
			
			<!-- start services-->
			<section class="services">
				<div class="bg-product2">
					<div class="contain-product2">
						<div class="container">
							
							<div class="row">
								<div class="col col-md-12 content">
									<div class="row">
										<div class="col col-md-8 col-sm-8 pull-right wow fadeInLeftSlow prd-section">
											<div class="solution-title">
												<h3 style="color:white;text-align:right !important">Solusi bagi helm yang berbau tidak sedap <br>dan membuat gatal kulit kepala</h3>
												<p style="color:white;text-align:right !important">Cuma Elsozo yang sudah teruji secara klinis mampu membunuh <br> sumber bau tidak sedap, yaitu bakteria, jamur, kuman atau virus.<br><br>Semprotkan ELSOZO pada bagian dalam helm lalu biarkan sesaat. <br> Helm jadi Fresh, Wangi, dan Nyaman untuk digunakan. </p>
												
											</div>
											
											
										</div>
										
									</div>
									
									
								</div>
								
							</div> <!-- end row -->
							
							
							</div> <!-- end container -->
							</div>
								
				</div>
			</section>
			<!-- end services-->
			
			<!-- start fun-fact -->
			<section class="fun-fact parallax" data-bg-image="images/fun-fact-bg.jpg">
				<div class="container">  
					<div class="row">
						<div class="col col-sm-12">
							<h2 style="font-size:37pt;margin-bottom:30px;padding-bottom:30px">3 Manfaat ELSOZO</h2>
						</div>
					</div>
					<div class="row">
						<div class="col col-sm-4 col-xs-6">
							<div class="box">
								<div class="icon">
									<!--i class="fi flaticon-people"></i-->
									<img src="images/bakteri_kuman.png" class="img-responsive">
								</div>
								
								<p style="padding-top:5%;font-size:30px !important;font-weight: bold;line-height: 1;">Bakteri dan kuman mati</p>
							</div>
						</div>
						<div class="col col-sm-4 col-xs-6">
							<div class="box">
								<div class="icon">
									<img src="images/menghilangkan_bau.png" class="img-responsive">
								</div>
								<p style="padding-top:5%;font-size:30px !important;font-weight: bold;line-height: 1;">Menghilangkan bau</p>
							</div>
						</div>
						<div class="col col-sm-4 col-xs-6">
							<div class="box">
								<div class="icon">
									<img src="images/hidup_higienis.png" class="img-responsive">
								</div>
								<p style="padding-top:5%;font-size:30px !important;font-weight: bold;line-height: 1;">Pola hidup higienis</p>
							</div>
						</div>
					</div> <!-- end row -->
				</div> <!-- end container -->
			</section>
			<!-- end fun-fact -->
			
			<!-- start fun-fact -->
			<section class="fun-fact parallax" style="background:#3a383a">
				
				<div class="row">
					<div class="col col-sm-12">
						<center><img src="images/logo_besar.png" class="img-responsive" style="padding: 0 10%;  "></center>
						<div class="title-other">
							<h2 style="color:#fff;">Dapat digunakan pada produk otomotif lainnya</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col col-sm-2 col-sm-offset-1">
						<div class="box">
							<div class="icon">
								<img src="images/gbr1.png">
							</div>
							
							
						</div>
					</div>
					<div class="col col-sm-2">
						<div class="box">
							<div class="icon">
								<img src="images/gbr2.png">
							</div>
							
							
						</div>
					</div>
					<div class="col col-sm-2">
						<div class="box">
							<div class="icon">
								<img src="images/gbr3.png">
							</div>
							
						</div>
					</div>
					<div class="col col-sm-2">
						<div class="box">
							<div class="icon">
								<img src="images/gbr4.png">
							</div>
							
						</div>
					</div>
					<div class="col col-sm-2">
						<div class="box">
							<div class="icon">
								<img src="images/gbr5.png">
							</div>
							
						</div>
					</div>
				</div> <!-- end row -->
				<!-- end container -->
			</section>
			<!-- end fun-fact -->
			
			<!-- start projects-->
			<section class="projects section-padding project-gallery" id="article">
				<div class="container">
					<div class="row section-title">
						<h1>Event</h1>
					</div> <!-- end section-title -->
					
					<div class="row">
						<div class="col col-lg-12">
							<div class="project-filters">
								
							</div>
							
							<div class="project-container popup-gallery project-grids">
								
								<?php
									$stmt = $mysqli->query("select * from tbl_artikel order by created_at DESC limit 0,3");
									while($artikel = $stmt->fetch_object()){
									?>
										<div class="col-bs9-3">
											<div class="article__grid">
												<div class="article__boxsubtitle ">
													<h2 class="article__subtitle" style="font-family:'Arial Black'"><?php echo $artikel->tag; ?></h2>
												</div>
												<div class="article__asset">
													<a href="<?php echo getPengaturan("url_website")->value."/".$artikel->gambar_artikel; ?>"><img src="<?php echo getPengaturan("url_website")->value."/".$artikel->gambar_artikel; ?>" alt="Akibat Cemari Kali Bekasi, Dua Perusahaan Disegel Pemerintah"/></a>
												</div>
												<div class="article__box">
													<h3 class="article__title"><a class="article__link" href="<?php echo getPengaturan("url_website")->value."/".$artikel->gambar_artikel; ?>" style="font-family:'Arial Black'"><?php echo $artikel->judul_artikel; ?></a></h3>
													<div class="article__lead" style="font-family:'Arial Black';font-size: 0.75em;">
														<?php echo $artikel->isi_artikel; ?>
													</div>			
													<div class="article__date" style="font-family:'Arial Black'"><?php echo date("d/m/Y , H:i:s",strtotime($artikel->created_at)); ?> WIB</div>
												</div>
											</div>
										</div>
									<?php
									}
								?>
							</div>
						</div> <!-- end col -->
					</div> <!-- end row -->
					<div class="view-all" style="border-bottom:4px solid #000;margin-top:25px;">
						
						
					</div>
				</div> <!-- end container -->
			</section>
			<!-- end projects-->
			
			<!-- start intro-->
			<section class="intro">
				
				<div class="row">
					<div class="col col-xs-12">
						<div class="box wow bounceInLeft" data-wow-delay="0.3s">
							<h1 style="font-size:42pt;">Helm jadi <label style="color:#1d878c;font-style:italic;">FRESH,</label></h1>
							<h1 style="padding-left:20%;font-size:42pt;"><label style="color:#1d878c;font-style:italic;">WANGI</label>&nbsp dan <label style="color:#1d878c;font-style:italic;">NYAMAN</label>&nbsp untuk digunakan</h1> 
							
						</div>
					</div>
				</div> <!-- end row -->
				
			</section>
			<!-- end intro-->
			
			
			<?php
				include "footer.php";
			?>
		</div>
		<!-- end of page-wrapper -->
	</div>
	
	<!-- All JavaScript files
	================================================== -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<!-- Plugins for this template -->
	<script src="js/jquery-plugin-collection.js"></script>
	
	<!-- Custom script for this template -->
	<script src="js/script.js"></script>
</body>
</html>
