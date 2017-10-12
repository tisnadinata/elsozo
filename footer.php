<!-- start footer -->
			<footer id="contact">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
				style="background-color: #13445a; padding-bottom:15px;">
					
					
					<div class="col-lg-3 col-lg-offset-1 col-md-6 col-sm-6 col-xs-12">
						<p class="TitleFooter">About us</p>
						<span style="color:#b1b5b8;font-size:0.75em"><?php echo getPengaturan("deskripsi_website")->value; ?></span>

						
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<p class="TitleFooter">Alamat</p>
                        <b style="color:#b1b5b8;font-size:0.75em">
							<?php echo getPengaturan("alamat")->value; ?>
							<br><br>Tel: <?php echo getPengaturan("telepon")->value; ?>
						</b>
					</div>
					
					<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
						<p class="TitleFooter">Sosial Media</p>
						<a href="<?php echo getPengaturan("facebook")->value; ?>" target="_blank"><img src="../images/fb.png" width="50px"></a>
						<a href="<?php echo getPengaturan("instagram")->value; ?>" target="_blank"><img src="../images/ig.png" width="50px"></a>
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<p class="TitleFooter">Newsletter</p>
						
						<div class="BoxFooter" style="font-size:0.75em">
							<center>
								<div style="color:#b1b5b8;">
									Join our mailing list to receive news and announcement
								</div>
								<?php
									if(isset($_POST['subscribe'])){
										$stmt = $mysqli->query("insert into tbl_subscribe(email) values('".$_POST['email']."')");
										echo'
											<btn class="btn btn-info btn-xs" value="BERHASIL MENGIKUTI"></btn>
										';
									}
								?>
								<form action="" method="post">
									<input type="email" name="email" style="border:1px solid #18536e;height:35px;margin-top: 10px;opacity: 0.75;width: 100%;" required/>
									<button class="ButtonFooter" name="subscribe" type="submit" style=" margin-top: 15px;">SUBCRIBE</button>
								</form>
							</center>
						</div>
						
					</div>
					
					
				</div>
				
				<!--/footer-->
			</footer><!-- end footer -->