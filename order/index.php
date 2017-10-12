<?php
	include_once '../config/config_modul.php';
	date_default_timezone_set('Asia/Jakarta');
	if(!isset($_SESSION['login_id'])){
			header("location:".getPengaturan("url_website")->value."/login");
	}else{
		if($_SESSION['email'] == "" OR $_SESSION['telepon'] == "0"){
			header("location:".getPengaturan("url_website")->value."/login/emailtelepon.php");
		}
	}
	
	if(!isset($_SESSION['order'])){
		$_SESSION['orderStep1'] = "active";
		$_SESSION['orderStep2'] = "deactive";
		$_SESSION['orderStep3'] = "deactive";
		$_SESSION['orderStep4'] = "deactive";
		$_SESSION['order_produk'] = null;
		$_SESSION['order_qty'] = null;
		$_SESSION['order_invoice'] = null;
		$_SESSION['order_code'] = null;
		$_SESSION['order_alamat'] = null;
		$_SESSION['order_catatan'] = null;
		$_SESSION['order_pengiriman'] = null;
		
	}
	if(isset($_POST['orderStep1'])){
		$_SESSION['order_produk'] = $_POST['produk'];
		$_SESSION['order_qty'] = $_POST['qty'];
		$_SESSION['order_invoice'] = generate_trans_invoice();
		$_SESSION['order_code'] = generate_trans_code();
		$_SESSION['orderStep1'] = "deactive";
		$_SESSION['orderStep2'] = "active";
		$_SESSION['orderStep3'] = "deactive";
		$_SESSION['orderStep4'] = "deactive";
		$_SESSION['order'] = true;
	}
	if(isset($_POST['orderStep2'])){
		$_SESSION['order_invoice'] = generate_trans_invoice();
		$_SESSION['order_code'] = generate_trans_code();
		$_SESSION['order_alamat'] = $_POST['alamat'].", ".$_SESSION['ongkir_kota'].", ".$_SESSION['ongkir_provinsi']." ".$_POST['pos'];
		$_SESSION['order_catatan'] = $_POST['catatan'];
		$_SESSION['layanan'] = explode("-",$_POST['layanan']);
		$_SESSION['order_pengiriman_ongkir'] = $_SESSION['layanan'][2];
		$_SESSION['order_pengiriman'] = $_SESSION['layanan'][0]."-".$_SESSION['layanan'][1];
		$_SESSION['orderStep1'] = "deactive";
		$_SESSION['orderStep2'] = "deactive";
		$_SESSION['orderStep3'] = "active";
		$_SESSION['orderStep4'] = "deactive";
	}
	if(isset($_POST['orderStep3'])){
		finishCheckout();
		$_SESSION['orderStep1'] = "deactive";
		$_SESSION['orderStep2'] = "deactive";
		$_SESSION['orderStep3'] = "deactive";
		$_SESSION['orderStep4'] = "active";
	}
	if(isset($_POST['backStep1'])){
		$_SESSION['orderStep1'] = "active";
		$_SESSION['orderStep2'] = "deactive";
		$_SESSION['orderStep3'] = "deactive";
	}
	if(isset($_POST['backStep2'])){
		$_SESSION['orderStep1'] = "deactive";
		$_SESSION['orderStep2'] = "active";
		$_SESSION['orderStep3'] = "deactive";
	}
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
			function orderButton(){
				window.location.href = "<?php echo getPengaturan("url_website")->value;?>/order";
			}
		function set_ongkir_provinsi(provinsi){
			var dataString = 'ongkir_provinsi='+provinsi;
			document.getElementById('ongkir_kota').innerHTML = "<option>Mengambil data kota/kabupaten...</option>";
			$.ajax({
				type: "POST",
				url: "<?php echo getPengaturan("url_website")->value;?>/order/ajax.php",
				data: dataString,
				cache: false,
				success: function(html) {
					document.getElementById('ongkir_kota').innerHTML = html;
				}
			});
		}
		function set_ongkir_kota(kota){
			var dataString = 'ongkir_kota='+kota;
			document.getElementById('ongkir_pos').value = "Mengambil data pos...";
			document.getElementById('ongkir_layanan').innerHTML = "<option>Mengambil data ekspedisi...</option>";
			$.ajax({
				type: "POST",
				url: "<?php echo getPengaturan("url_website")->value;?>/order/ajax.php",
				data: dataString,
				cache: false,
				success: function(html) {
					document.getElementById('ongkir_pos').value = html;
				}
			});
			set_ongkir_layanan(kota);
		}
		function set_ongkir_layanan(kota){
			var dataString = 'ongkir_layanan='+kota;
			$.ajax({
				type: "POST",
				url: "<?php echo getPengaturan("url_website")->value;?>/order/ajax.php",
				data: dataString,
				cache: false,
				success: function(html) {
					document.getElementById('ongkir_layanan').innerHTML = html;
				}
			});
		}
		function PrintElem(elem){
			var mywindow = window.open('', 'PRINT', 'height=400,width=600');

			mywindow.document.write('<html><head><title>' + document.title  + '</title>');
			mywindow.document.write('</head><body >');
			mywindow.document.write('<h1>' + document.title  + '</h1>');
			mywindow.document.write(document.getElementById(elem).innerHTML);

			mywindow.document.close(); // necessary for IE >= 10
			mywindow.focus(); // necessary for IE >= 10*/

			mywindow.print();
			mywindow.close();

			return true;
		}
		function landingButton(){
			window.location.href = "<?php echo getPengaturan("url_website")->value;?>";
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
								<li class="current"><a href="#" >Order Now</a></li>
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
						<?php
							if($_SESSION['orderStep1'] == "active"){
						?>
							<div class="panel panel-success">
							  <div class="panel-heading">
								<b>Step 1</b> - Select Your Product
							  </div>
							  <div class="panel-body">
								<form name="frm-select-product" id="frm-select-product" class="form-horizontal" action="" method="post">
									<table class="table table-bordered table-striped table-hover table-condensed" width="100%">
										<thead>
											<tr>
												<th>PRODUCT DETAIL</th>
												<th width="20%">QTY</th>
											</tr>
										</thead>
										<tbody>
											<!-- TRANSAKSI TIPE 1 - SINGLE PRODUCT ORDER -->
											<tr>
												<td>
													<select class="form-control" name="produk[0]">
													<?php
														$listProduk = getDataTable("tbl_produk","nama_produk ASC");
														while($getProduk = $listProduk->fetch_object()){
															?>
															<option value="<?php echo $getProduk->nama_produk;?>"><?php echo $getProduk->nama_produk." - Rp".setHargaRupiah($getProduk->harga_produk)." - ".$getProduk->berat_produk." gram";?></option>
															<?php
														}
													?>
													</select>
												</td>
												<td>
													<input type="number" class="form-control" value="1" min="1" name="qty[0]" required>
												</td>
											</tr>
											<!-- END TRANSAKSI TIPE 1-->
											<!-- TRANSAKSI TIPE 2 - MULTI PRODUCT ORDER -->
											<?php
												// $no = 0;
												// $listProduk = getDataTable("tbl_produk","nama_produk ASC");
												// while($getProduk = $listProduk->fetch_object()){
													// ?>
													<!--
													<tr>
														<td>
															<input type="hidden" value="<?php echo $getProduk->nama_produk; ?>" name="produk[<?php echo $no; ?>]">
															<label><?php echo $getProduk->nama_produk;?></label><br>
															<small>Rp<?php echo setHargaRupiah($getProduk->harga_produk);?> (Berat : <?php echo $getProduk->berat_produk;?>  gram)</small>
														</td>
														<td>
															<input type="number" class="form-control" value="0" min="0" name="qty[<?php echo $no; ?>]">
														</td>
													</tr>
													-->
													<?php
													// $no++;
												// }
											// ?>
											<!-- END TRANSAKSI TIPE 2-->
										</tbody>
									</table>
									<button type="submit" class="btn btn-success btn-sm pull-right" name="orderStep1" >Order This Product <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
								</form>
									<a href="<?php echo getPengaturan("url_website")->value; ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</a>
							  </div>
							</div>
						<?php
							}
						?>
						<?php
							if($_SESSION['orderStep2'] == "active"){
						?>
							<div class="panel panel-success">
							  <div class="panel-heading">
								<b>Step 2</b> - Order and Shipment Detail
							  </div>
							  <div class="panel-body">
								<form class="form-horizontal" action="" method="post">
									<div class="form-group">
									  <label class="col-md-3 control-label">ORDER INVOICE</label>
									  <div class="col-md-9">
										<input type="text" class="form-control" id="invoice" value="<?php echo $_SESSION['order_invoice'] ?>" readonly>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-3 control-label">ALAMAT PENGIRIMAN<br><small class="label label-danger">pastikan kode pos sesuai</small></label>
									  <div class="col-md-9" style="padding:0px;">
										<div class="col-md-6 col-xs-12">
											<select class="form-control" name="provinsi" id="ongkir_provinsi"  onchange="set_ongkir_provinsi(this.value)">
											  <option>Pilih Provinsi</option>
											  <?php
												$json = json_decode(file_get_contents("http://api.rajaongkir.com/starter/province?key=eb153f83729347ff96ac2e7c8f2a3469"));
												$json = ($json->rajaongkir);
												for($i = 0;$i<count($json->results);$i++){
													?>
														<option value="<?php echo $json->results[$i]->province_id.'-'.$json->results[$i]->province;?>"><?php echo $json->results[$i]->province;?></option>		
													<?php
												}
											?>     
											</select>
										</div>
										<div class="col-md-6 col-xs-12">
											<select class="form-control" name="kota" id="ongkir_kota" onchange="set_ongkir_kota(this.value)">
											  <option>Pilih Kota/Kabupaten</option>
											</select>
										</div>
										<div class="col-md-12">
											<br>
										</div>
										<div class="col-md-6 col-xs-12">
											<input type="text" class="form-control" name="pos" placeholder="ubah kode pos jika tidak sesuai" id="ongkir_pos">
										</div>
										<div class="col-md-6 col-xs-12">
											<select class="form-control" name="layanan" id="ongkir_layanan">
											  <option>Metode Pengiriman</option>
											</select>
										</div>
										<div class="col-md-12">
											<br>
										</div>
										<div class="col-md-12">
											<textarea class="form-control" name="alamat" required>Alamat anda</textarea>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-3 control-label">CATATAN PENGIRIMAN</label>
									  <div class="col-md-9">
										<textarea class="form-control" name="catatan" required>isi jika ada</textarea>
									  </div>
									</div>
									<button type="submit" class="btn btn-success btn-sm pull-right" name="orderStep2" >Checkout Now <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
									<button type="submit" class="btn btn-warning btn-sm" name="backStep1" ><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</button>
								</form>
							  </div>
							</div>
						<?php
							}
						?>
						<?php
							if($_SESSION['orderStep3'] == "active"){
						?>
							<div class="panel panel-success">
							  <div class="panel-heading">
								<b>Step 3</b> - Checkout and Finish Transactions
							  </div>
							  <div class="panel-body">
								<form name="frm-select-product" id="frm-select-product" class="form-horizontal" action="" method="post">
									<table class="table table-condensed" width="100%">
										<tbody>
											<tr>
												<td><strong>Nomor Invoice</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['order_invoice']; ?></td>
											</tr>
											<tr>
												<td><strong>Atas Nama</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['display_name']; ?></td>
											</tr>
											<tr>
												<td><strong>Tanggal Transaksi</strong></td>
												<td>: </td>
												<td><?php echo date("d-m-Y H:i:s"); ?></td>
											</tr>
											<tr>
												<td><strong>Alamat Pengiriman</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['order_alamat']; ?></td>
											</tr>
											<tr>
												<td><strong>Metode Pengiriman</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['order_pengiriman']; ?></td>
											</tr>
											<tr>
												<td><strong>Catatan :</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['order_catatan']; ?></td>
											</tr>
											<tr>
												<td colspan="3"><strong>Detail Pembelian dan Biaya :</strong></td>
											</tr>
											<tr>
												<td colspan="3">
													<table class="table table-bordered table-condensed" width="100%">
														<thead style="background-color:#18bc9c">
															<tr>
																<th>Nama Produk</th>
																<th>Berat Produk</th>
																<th>Harga Produk</th>
																<th>Qty</th>
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
														<?php
															$totalsub = 0;
															$totalberat = 0;
															for($i=0;$i<count($_SESSION['order_produk']);$i++){
																$getProduk = getDataByCollumn("tbl_produk","nama_produk",$_SESSION['order_produk'][$i])->fetch_object();
																$sub[$i] = $getProduk->harga_produk*$_SESSION['order_qty'][$i];
																$totalsub = $totalsub + $sub[$i];
																$totalberat = $totalberat+($getProduk->berat_produk*$_SESSION['order_qty'][$i]);
															?>
															<tr>
																<td><?php echo $getProduk->nama_produk ; ?></td>
																<td align="center"><?php echo $getProduk->berat_produk ; ?> gram</td>
																<td align="center">Rp <?php echo setHargaRupiah($getProduk->harga_produk) ; ?></td>
																<td align="center"><?php echo $_SESSION['order_qty'][$i] ; ?></td>
																<td align="right">Rp <?php echo setHargaRupiah($sub[$i]) ; ?></td>
															</tr>
															<?php
															}
															$totalberat = ceil($totalberat/1000);
															$_SESSION['order_subtotal'] = $totalsub;
															$_SESSION['order_ongkir'] = $_SESSION['order_pengiriman_ongkir']*$totalberat;
															$totaltransaksi = $_SESSION['order_subtotal']+$_SESSION['order_ongkir']+$_SESSION['order_code'];
														?>
															<tr>
																<td colspan="4" align="right"><strong>Subtotal Produk</strong></td>
																<td align="right">Rp <?php echo setHargaRupiah($_SESSION['order_subtotal']); ?></td>
															</tr>
															<tr>
																<td colspan="4" align="right"><strong>Ongkos Kirim</strong><small>(total berat dalam kg*harga per kg)</small></td>
																<td align="right">Rp <?php echo setHargaRupiah($_SESSION['order_ongkir']); ?></td>
															</tr>
															<tr>
																<td colspan="4" align="right"><strong>Kode Unik Transaksi</strong></td>
																<td align="right"><?php echo setHargaRupiah($_SESSION['order_code']); ?></td>
															</tr>
															<tr>
																<td colspan="4" align="right"><strong>Total Biaya Transaksi <font color="red">Yang Harus Dibayar</font></strong></td>
																<td align="right"><strong>Rp <?php echo setHargaRupiah($totaltransaksi); ?></strong></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="alert alert-danger" role="alert"><center>PASTIKAN SEMUA DATA PRODUK YANG DIBELI, ALAMAT PENGIRIMAN DAN BIAYA TRANSAKSI ANDA SUDAH BENAR-BENAR SESUAI SEBELUM MENEKAN <span class="label label-success">Finish Order <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></span></center></div>
									<button type="submit" class="btn btn-success btn-sm pull-right" name="orderStep3" >Finish Order <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>
									<button type="submit" class="btn btn-warning btn-sm" name="backStep2" ><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</button>
								</form>
							  </div>
							</div>
						<?php
							}
						?>
						<?php
							if($_SESSION['orderStep4'] == "active"){
						?>
							<div class="panel panel-success">
							  <div class="panel-heading">
								<b>Step 3</b> - Checkout and Finish Transactions
							  </div>
							  <div class="panel-body">
							  <div id="invoice-user">
									<table class="table table-condensed" width="100%">
										<tbody>
											<tr>
												<td><strong>Nomor Invoice</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['order_invoice']; ?></td>
											</tr>
											<tr>
												<td><strong>Atas Nama</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['display_name']; ?></td>
											</tr>
											<tr>
												<td><strong>Tanggal Transaksi</strong></td>
												<td>: </td>
												<td><?php echo date("d-m-Y H:i:s"); ?></td>
											</tr>
											<tr>
												<td><strong>Alamat Pengiriman</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['order_alamat']; ?></td>
											</tr>
											<tr>
												<td><strong>Metode Pengiriman</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['order_pengiriman']; ?></td>
											</tr>
											<tr>
												<td><strong>Catatan :</strong></td>
												<td>:</td>
												<td><?php echo $_SESSION['order_catatan']; ?></td>
											</tr>
											<tr>
												<td colspan="3"><strong>Detail Pembelian dan Biaya :</strong></td>
											</tr>
											<tr>
												<td colspan="3">
													<table class="table table-bordered table-condensed" width="100%">
														<thead style="background-color:#18bc9c">
															<tr>
																<th>Nama Produk</th>
																<th>Berat Produk</th>
																<th>Harga Produk</th>
																<th>Qty</th>
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
														<?php
															$totalsub = 0;
															$totalberat = 0;
															for($i=0;$i<count($_SESSION['order_produk']);$i++){
																$getProduk = getDataByCollumn("tbl_produk","nama_produk",$_SESSION['order_produk'][$i])->fetch_object();
																$sub[$i] = $getProduk->harga_produk*$_SESSION['order_qty'][$i];
																$totalsub = $totalsub + $sub[$i];
																$totalberat = $totalberat+($getProduk->berat_produk*$_SESSION['order_qty'][$i]);
															?>
															<tr>
																<td><?php echo $getProduk->nama_produk ; ?></td>
																<td align="center"><?php echo $getProduk->berat_produk ; ?> gram</td>
																<td align="center">Rp <?php echo setHargaRupiah($getProduk->harga_produk) ; ?></td>
																<td align="center"><?php echo $_SESSION['order_qty'][$i] ; ?></td>
																<td align="right">Rp <?php echo setHargaRupiah($sub[$i]) ; ?></td>
															</tr>
															<?php
															}
															$totalberat = ceil($totalberat/1000);
															$_SESSION['order_subtotal'] = $totalsub;
															$_SESSION['order_ongkir'] = $_SESSION['order_pengiriman_ongkir']*$totalberat;
															$totaltransaksi = $_SESSION['order_subtotal']+$_SESSION['order_ongkir']+$_SESSION['order_code'];
														?>
															<tr>
																<td colspan="4" align="right"><strong>Subtotal Produk</strong></td>
																<td align="right">Rp <?php echo setHargaRupiah($_SESSION['order_subtotal']); ?></td>
															</tr>
															<tr>
																<td colspan="4" align="right"><strong>Ongkos Kirim</strong><small>(total berat dalam kg*harga per kg)</small></td>
																<td align="right">Rp <?php echo setHargaRupiah($_SESSION['order_ongkir']); ?></td>
															</tr>
															<tr>
																<td colspan="4" align="right"><strong>Kode Unik Transaksi</strong></td>
																<td align="right"><?php echo setHargaRupiah($_SESSION['order_code']); ?></td>
															</tr>
															<tr>
																<td colspan="4" align="right"><strong>Total Biaya Transaksi <font color="red">Yang Harus Dibayar</font></strong></td>
																<td align="right"><strong>Rp <?php echo setHargaRupiah($totaltransaksi); ?></strong></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="alert alert-danger" role="alert"><center>SIMPAN BUKTI INVOICE TRANSAKSI SEBAGAI BUKTI TRANSAKSI ANDA</center></div>
								<a href="#" class="btn btn-info btn-sm col-md-12" onClick="PrintElem('invoice-user')">Print/Save Invoice <span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
									<center> atau </center>
								<a href="redirect.php" class="btn btn-info btn-sm col-md-12" >Back to Home<span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
							  </div>
							</div>
						<?php
							}
						?>
						<a href="<?php echo getPengaturan("url_website")->value;?>/konfirmasi" class="btn btn-info col-md-12"> KONFIRMASI PEMBAYARAN </a>
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
