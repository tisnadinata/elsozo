<div class="row top_tiles">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
	  <div class="count">
		<?php
			$stmt = $mysqli->query("select *  from tbl_users");
			echo $stmt->num_rows;
		?>
	  </div>
	  <h3>User Terdaftar</h3>
	</div>
  </div>  
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
	  <div class="count">
		<?php
			$stmt = $mysqli->query("select *  from tbl_produk");
			echo $stmt->num_rows;
		?>
	  </div>
	  <h3>Produk Terdaftar</h3>
	</div>
  </div>  
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
	  <div class="count">
		<?php
			$stmt = $mysqli->query("select * from tbl_transaksi where status_transaksi = 'confirmed' group by invoice ");
			echo $stmt->num_rows;
		?>
	  </div>
	  <h3>Transaksi Baru </h3>
	</div>
  </div>  
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
	  <div class="count">
		<?php
			$stmt = $mysqli->query("select * from tbl_transaksi where status_transaksi = 'done' group by invoice");
			echo $stmt->num_rows;
		?>
	  </div>
	  <h3>Transaksi Selesai </h3>
	</div>
  </div>  
</div>