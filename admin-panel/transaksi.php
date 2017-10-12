              <div class="col-md-12 col-sm-12 col-xs-12">
                <?php
				if(isset($_GET['set'])){
					date_default_timezone_set('Asia/Jakarta');
					$set = explode('-',$_GET['set']);					
					$invoice=getDataByCollumn("tbl_transaksi","id_transaksi",$set[1])->fetch_object();
					$status_transaksi=strtolower($set[0]);
					$stmt = $mysqli->query("update tbl_transaksi set status_transaksi= '$status_transaksi' where invoice='".$invoice->invoice."'");
					if($set[0] == 'PROCESSING'){
						$page = '?page=transaksi&status=proses';
					}else if($set[0] == 'SHIPPED'){
						$page = '?page=transaksi&status=dikirim';
					}else if($set[0] == 'CANCELED'){
						$page = '?page=transaksi&status=dibatalkan';
					}else if($set[0] == 'DONE'){
						$page = '?page=transaksi&status=selesai';
					}
					
					if($stmt){
						echo'
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<strong>Status Transaksi Berhasil di Ubah!</strong> .
							</div>							
							<meta http-equiv="Refresh" content="2; URL='.$page.'">
						';
					}else{
						echo'
							<div class="alert alert-danger alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<strong>Status Transaksi Gagal di Ubah!</strong> .
							</div>
						';
					}
				}
				$status_dicari = "CONFIRMED,PROCESSING,SHIPPED,DONE,CANCELED";
				if(isset($_GET['status'])){
					if($_GET['status'] == 'pending'){
						$status_dicari = "pending";
					}else if($_GET['status'] == 'baru'){
						$status_dicari = "confirmed";
					}else if($_GET['status'] == 'proses'){
						$status_dicari = "processing";
					}else if($_GET['status'] == 'dikirim'){
						$status_dicari = "shipped";
					}else if($_GET['status'] == 'selesai'){
						$status_dicari = "done";
					}else if($_GET['status'] == 'dibatalkan'){
						$status_dicari = "canceled";
					}
				}
				if(!isset($_GET['set'])){
			  ?>
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Data Transaksi </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
						Gunakan tombol disebelah kanan pada setiap data untuk mengubah atau menghapus data.
                    </p>
                    <table id="datatable" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Nomo Invoice</th>
                          <th>Nama Pembeli</th>
                          <th>Waktu Transaksi</th>
                          <th>Total Bayar</th>
                          <th>Status</th>
                          <th style="width:14.5%"></th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
							$stmt = getDataByCondition("tbl_transaksi","status_transaksi = '$status_dicari' GROUP BY invoice","id_transaksi DESC");
							if($stmt->num_rows>0){
								while($data_transaksi = $stmt->fetch_object()){
									$data_users = getDataByCollumn("tbl_users","id_users",$data_transaksi->id_users)->fetch_object();
									echo"
										<tr>
										  <th>".$data_transaksi->invoice."</th>
										  <th>".$data_users->display_name."</th>
										  <th>".$data_transaksi->created."</th>
										  <th>Rp".setHargaRupiah($data_transaksi->subtotal+$data_transaksi->ongkos_kirim)."</th>
										  <th>".$data_transaksi->status_transaksi."</th>
										  <td>";
											if($_GET['status'] == 'baru'){
												echo"
													<a href='?page=transaksi&set=PROCESSING-".$data_transaksi->id_transaksi."' class='btn btn-info btn-sm' title='Proses Transaksi' /><i class='fa fa-check'></i></a>
												";
											}else if($_GET['status'] == 'proses'){
												?>
													<a onclick="alert('Silahkan masukan nomor resi di bagian detail pesanan...')" href='?page=transaksi&set=SHIPPED-<?php echo $data_transaksi->id_transaksi;?>' class='btn btn-primary btn-sm' title='Kirim Transaksi' /><i class='fa fa-truck'></i></a>
												<?php
											}else if($_GET['status'] == 'dikirim'){
												echo"
													<a href='?page=transaksi&set=DONE-".$data_transaksi->id_transaksi."' class='btn btn-success btn-sm' title='Transaksi terlah berhasil' />DONE</a>
												";
											}
											echo"
											<a target='_blank' href='?page=detail-transaksi&transaksi=".$data_transaksi->id_transaksi."' class='btn btn-default btn-sm' title='Detail Transaksi' /><i class='fa fa-eye'></i></a>
											<a href='?page=transaksi&set=CANCELED-".$data_transaksi->id_transaksi."' class='btn btn-danger btn-sm' title='Tolak Transaksi' /><i class='fa fa-remove'></i></a>
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
				<?php } ?>