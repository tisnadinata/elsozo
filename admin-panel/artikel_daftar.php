              <div class="col-md-12 col-sm-12 col-xs-12">
                <?php
				if(isset($_GET['delete'])){
					$stmt = $mysqli->query("select * from tbl_artikel where id_artikel=".$_GET['delete']."");
					if($stmt->num_rows > 0){
						$foto = $stmt->fetch_object();
						$delete = $mysqli->query("delete from tbl_artikel where id_artikel=".$_GET['delete']."");
						if($delete){
							unlink("../".$foto->gambar_artikel);
							echo'
								<div class="alert alert-success alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<strong>Data berhasil dihapus!</strong> .
								</div>
								<meta http-equiv="Refresh" content="2; URL=?page=artikel-daftar">
							';						
						}else{
							echo'
								<div class="alert alert-danger alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<strong>Data gagal dihapus!</strong> .
								</div>
							';
						}
					}else{
						echo'
							<div class="alert alert-danger alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<strong>Artikel tidak ditemukan!</strong> .
							</div>
						';
					}
				}
			  ?>
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Data artikel</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
						Gunakan tombol disebelah kanan pada setiap data untuk mengubah atau menghapus data.
                    </p>
                    <table id="datatable" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th style="width:35%">Judul Artikel</th>
                          <th style="width:40%">Isi Artikel</th>
                          <th>TAG</th>
                          <th>Foto</th>
                          <th style="width:11.2%"></th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
							$stmt = getDataTable("tbl_artikel where id_artikel !=0","created_at DESC");
							if($stmt->num_rows>0){
								while($data_artikel = $stmt->fetch_object()){
									echo"
										<tr>
										  <th>".$data_artikel->judul_artikel."</th>
										  <th>".$data_artikel->isi_artikel."</th>
										  <th>".$data_artikel->tag."</th>
										  <th><a href='".getPengaturan('url_website')->value."/".$data_artikel->gambar_artikel."' target='_blank'>LIHAT</a></th>
										  <td>
											<a href='?page=artikel-tambah&edit=".$data_artikel->id_artikel."' type='submit' class='btn btn-info' title='Edit Data' /><i class='fa fa-edit'></i></a>
											<a href='?page=artikel-daftar&delete=".$data_artikel->id_artikel."' type='submit' class='btn btn-danger' title='Hapus Data' /><i class='fa fa-trash'></i></a>
										  </td>
										</tr>
									";
								}
							}else{
								echo"<tr><td colspan='7'>Belum ada data tersedia.</td></tr>";
							}
						?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
