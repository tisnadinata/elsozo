              <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Data Subscriber</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th style="width:5%">NO</th>
                          <th>EMAIL LENGKAP</th>
                          <th>JOIN AT</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
							$stmt=getDataTable("tbl_subscribe where id_subscribe != 0","created_at ASC");
							if($stmt->num_rows>0){
								$i=1;
								while($data_subscribe = $stmt->fetch_object()){
									echo'
										<tr>
										  <td>'.$i.'</td>
										  <td>'.$data_subscribe->email.'</td>
										  <td>'.$data_subscribe->created_at.'</td>
										</tr>								
									';
									$i++;
								}
							}else{
								echo"<tr><td colspan='4'>Belum ada data yang tersedia</td></tr>";
							}
						?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
