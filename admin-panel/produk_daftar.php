              <div class="col-md-12 col-sm-12 col-xs-12">
                <?php
				if(isset($_GET['delete'])){
					$stmt = $mysqli->query("select * from tbl_produk where id_produk=".$_GET['delete']."");
					if($stmt->num_rows > 0){
						$foto = $stmt->fetch_object();
						$delete = $mysqli->query("delete from tbl_produk where id_produk=".$_GET['delete']."");
						if($delete){
							unlink("../".$foto->foto_produk);
							echo'
								<div class="alert alert-success alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<strong>Data berhasil dihapus!</strong> .
								</div>
								<meta http-equiv="Refresh" content="2; URL=?page=produk-daftar">
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
								<strong>Produk tidak ditemukan!</strong> .
							</div>
						';
					}
				}
			  ?>
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Data Produk</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
						Gunakan tombol disebelah kanan pada setiap data untuk mengubah atau menghapus data.
                    </p>
                    <table id="datatable" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Nama Produk</th>
                          <th style="width:20%">Deskripsi</th>
                          <th>Harga Produk</th>
                          <th>Berat Produk</th>
                          <th>Foto</th>
                          <th>Video</th>
                          <th style="width:11.2%"></th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
							$stmt = getDataTable("tbl_produk where id_produk !=0","nama_produk ASC");
							if($stmt->num_rows>0){
								while($data_produk = $stmt->fetch_object()){
									echo"
										<tr>
										  <th>".$data_produk->nama_produk."</th>
										  <th>".substr($data_produk->deskripsi_produk,0,100)."</th>
										  <th>Rp".setHargaRupiah($data_produk->harga_produk)."</th>
										  <th>".$data_produk->berat_produk." gram</th>
										  <th><a href='".getPengaturan('url_website')->value."/".$data_produk->foto_produk."' target='_blank'>LIHAT</a></th>
										  <th><a href='".$data_produk->video_produk."' target='_blank'>LIHAT</a></th>
										  <td>
											<a href='?page=produk-tambah&edit=".$data_produk->id_produk."' type='submit' class='btn btn-info' title='Edit Data' /><i class='fa fa-edit'></i></a>
											<a href='?page=produk-daftar&delete=".$data_produk->id_produk."' type='submit' class='btn btn-danger' title='Hapus Data' /><i class='fa fa-trash'></i></a>
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
