              <div class="col-md-10 col-md-offset-1 col-xs-12">
			<?php				
				if(isset($_POST['simpan_data'])){
					$judul_artikel = $_POST['judul_artikel'];
					$isi_artikel = $_POST['isi_artikel'];
					$tag = $_POST['tag'];
					$respon = true;
					if(!isset($_GET['edit'])){
						$gambar_artikel = explode("-",upload_foto("../assets/artikel/",$_FILES['file_foto'],$judul_artikel));
						if($gambar_artikel[0] == "true"){
							$gambar_artikel = str_replace("../","",$gambar_artikel[1]);
						}else{
							$gambar_artikel = $gambar_artikel[1];
							$respon = false;
						}
						$sql = "INSERT into tbl_artikel(judul_artikel,isi_artikel,gambar_artikel,tag) 
						VALUES('$judul_artikel','$isi_artikel','$gambar_artikel','$tag')";
					}else{
						if(empty($_FILES['file_foto']['name'])){
							$gambar_artikel = $_POST['gambar_artikel'];
						}else{
							unlink('../'.$_POST['gambar_artikel']);
							$gambar_artikel = explode("-",upload_foto("../assets/artikel/",$_FILES['file_foto'],$judul_artikel));							
							if($gambar_artikel[0] == "true"){								
								$gambar_artikel = str_replace("../","",$gambar_artikel[1]);
							}else{
								$gambar_artikel = $gambar_artikel[1];
								$respon = false;
							}
						}
						$sql = "UPDATE tbl_artikel set judul_artikel='$judul_artikel',isi_artikel='$isi_artikel',
						tag='$tag',gambar_artikel='$gambar_artikel' where id_artikel=".$_GET['edit']." ";
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
								<meta http-equiv="Refresh" content="2; URL=?page=artikel-daftar">
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
								<strong>'.ucfirst($gambar_artikel).'!</strong> .
							</div>
						';
					}
				}
				if(!isset($_GET['edit'])){
					
			?>
				 <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Tambah Artikel</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Artikel</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="judul_artikel" placeholder="Nama Lengkap artikel" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi Artikel</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea class="form-control" rows="3" name="isi_artikel" placeholder='Deskripsi Lengkap artikel'></textarea>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tag Artikel</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="tag" placeholder="Tag artikel, contoh 'KESEHATAN'" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto artikel(max 2 mb)</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="file" class="form-control" name="file_foto" required>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success pull-right" name="simpan_data">Simpan Data artikel</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
			<?php
				}else{
					$judul_artikel = '';
					$isi_artikel = '';
					$gambar_artikel = '';
					$tag = '';
					$stmt = getDataByCollumn("tbl_artikel","id_artikel",$_GET['edit']);
					if($stmt->num_rows>0){
						$data_artikel = $stmt->fetch_object();
						$judul_artikel = $data_artikel->judul_artikel;
						$isi_artikel = $data_artikel->isi_artikel;
						$gambar_artikel = $data_artikel->gambar_artikel;
						$tag = $data_artikel->tag;
					}else{
						echo'
							<div class="alert alert-warning alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<strong>Data artikel tidak ditemukan!</strong> .
							</div>
						';
					}
			?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Edit Artikel</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="gambar_artikel" value="<?php echo $gambar_artikel;?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Artikel</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="judul_artikel" value="<?php echo $judul_artikel;?>" placeholder="Nama Lengkap artikel" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi Artikel</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea class="form-control" rows="3" name="isi_artikel" placeholder='Deskripsi Lengkap artikel'><?php echo $isi_artikel;?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tag Artikel</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="tag" value="<?php echo $tag;?>" placeholder="Tag artikel, contoh 'KESEHATAN'" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto artikel(max 2 mb)</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="file" class="form-control" name="file_foto">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success pull-right" name="simpan_data">Simpan Data artikel</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
			<?php
				}
			?>
