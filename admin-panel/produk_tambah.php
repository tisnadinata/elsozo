              <div class="col-md-10 col-md-offset-1 col-xs-12">
			<?php				
				if(isset($_POST['simpan_data'])){
					$nama_produk = $_POST['nama_produk'];
					$deskripsi_produk = $_POST['deskripsi_produk'];
					$video_produk = $_POST['video_produk'];
					$harga_produk = $_POST['harga_produk'];
					$berat_produk = $_POST['berat_produk'];
					$respon = true;
					if(!isset($_GET['edit'])){
						$foto_produk = explode("-",upload_foto("../assets/produk/",$_FILES['file_foto'],$nama_produk));
						if($foto_produk[0] == "true"){
							$foto_produk = str_replace("../","",$foto_produk[1]);
						}else{
							$foto_produk = $foto_produk[1];
							$respon = false;
						}
						$sql = "INSERT into tbl_produk(nama_produk,harga_produk,berat_produk,deskripsi_produk,foto_produk,video_produk) 
						VALUES('$nama_produk',$harga_produk,$berat_produk,'$deskripsi_produk','$foto_produk','$video_produk')";
					}else{
						if(empty($_FILES['file_foto']['name'])){
							$foto_produk = $_POST['foto_produk'];
						}else{
							unlink('../'.$_POST['foto_produk']);
							$foto_produk = explode("-",upload_foto("../assets/produk/",$_FILES['file_foto'],$nama_produk));							
							if($foto_produk[0] == "true"){								
								$foto_produk = str_replace("../","",$foto_produk[1]);
							}else{
								$foto_produk = $foto_produk[1];
								$respon = false;
							}
						}
						$sql = "UPDATE tbl_produk set nama_produk='$nama_produk',deskripsi_produk='$deskripsi_produk',harga_produk='$harga_produk',
						berat_produk='$berat_produk',video_produk='$video_produk',foto_produk='$foto_produk' where id_produk=".$_GET['edit']." ";
					}
					if($respon){
						$stmt = $mysqli->query($sql);
						if($stmt){
							echo'
								<div class="alert alert-success alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<strong>Data berhasil disimpan!</strong> .
								</div>
								<meta http-equiv="Refresh" content="2; URL=?page=produk-daftar">
							';						
						}else{
							echo'
								<div class="alert alert-danger alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<strong>Data gagal disimpan!</strong> .
								</div>
							';
						}
					}else{
						echo'
							<div class="alert alert-danger alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<strong>'.ucfirst($foto_produk).'!</strong> .
							</div>
						';
					}
				}
				if(!isset($_GET['edit'])){
					
			?>
				 <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Tambah Produk</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Produk</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="nama_produk" placeholder="Nama Lengkap Produk" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Produk</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea class="form-control" rows="3" name="deskripsi_produk" placeholder='Deskripsi Lengkap Produk'></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Produk(Rp)</label>
                        <div class="col-md-4 col-sm-8 col-xs-12">
                          <input type="number" class="form-control" name="harga_produk" value='1' min='1'required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat Produk(gram)</label>
                        <div class="col-md-4 col-sm-8 col-xs-12">
                          <input type="number" class="form-control" name="berat_produk" value='1' min='1'required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Produk</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="video_produk" placeholder="URL Youtube dari video"required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto Produk(max 2 mb)</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="file" class="form-control" name="file_foto" required>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success pull-right" name="simpan_data">Simpan Data Produk</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
			<?php
				}else{
					$kategori_produk = '';
					$nama_produk = '';
					$harga_produk = '';
					$berat_produk = '';
					$deskripsi_produk = '';
					$video_produk = '';
					$stmt = getDataByCollumn("tbl_produk","id_produk",$_GET['edit']);
					if($stmt->num_rows>0){
						$data_produk = $stmt->fetch_object();
						$nama_produk = $data_produk->nama_produk;
						$harga_produk = $data_produk->harga_produk;
						$berat_produk = $data_produk->berat_produk;
						$deskripsi_produk = $data_produk->deskripsi_produk;
						$foto_produk = $data_produk->foto_produk;
						$video_produk = $data_produk->video_produk;
					}else{
						echo'
							<div class="alert alert-warning alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<strong>Data produk tidak ditemukan!</strong> .
							</div>
						';
					}
			?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Edit Produk</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="foto_produk" value="<?php echo $foto_produk;?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Produk</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="nama_produk" value="<?php echo $nama_produk;?>" placeholder="Nama Lengkap Produk" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Produk</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea class="form-control" rows="3" name="deskripsi_produk" placeholder='Deskripsi Lengkap Produk'><?php echo $deskripsi_produk;?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Produk(Rp)</label>
                        <div class="col-md-4 col-sm-8 col-xs-12">
                          <input type="number" class="form-control" name="harga_produk"  value="<?php echo $harga_produk;?>" min='1'required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat Produk(gram)</label>
                        <div class="col-md-4 col-sm-8 col-xs-12">
                          <input type="number" class="form-control" name="berat_produk" value="<?php echo $berat_produk;?>" min='1'required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Produk</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="video_produk" value="<?php echo $video_produk;?>" placeholder="Url youtube dari video"required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto Produk(max 2 mb)</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="file" class="form-control" name="file_foto">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success pull-right" name="simpan_data">Simpan Data Produk</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
			<?php
				}
			?>
