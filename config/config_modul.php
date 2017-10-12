<?php
	require 'config_db.php';
	date_default_timezone_set('Asia/Jakarta');
	function getIpCustomer(){
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'IP Tidak Dikenali';
	 
		return $ipaddress;
	}
	function enkripPassword($value){
		return sha1(md5($value));	
	}
	function generate_trans_code(){
		global $mysqli;
		$invoice = 100;
		$stmt = $mysqli->query("select count(id_transaksi) as urut from tbl_transaksi");
		$row = $stmt->fetch_array();
		$urut = $row['urut']+1;
		$stmt->close();
		return $invoice+$urut;
	}
	function generate_trans_invoice(){
		global $mysqli;
		$tahun = date('y');
		 $array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
		$bulan = $array_bulan[date('n')];
		$invoice = "ELSOZO-".$tahun.'-'.$bulan.'-';
		$stmt = $mysqli->query("select count(id_transaksi) as urut from tbl_transaksi");
		$row = $stmt->fetch_array();
		$urut = $row['urut']+1+100;
		$stmt->close();
		return $invoice.$urut;
	}
	
	function setHargaRupiah($harga){
		return number_format($harga,0,",",".");
	}
	function upload_foto($destination_foto,$file_foto,$nama_foto){
		
			$ok_ext = array('jpg','png','jpeg'); // allow only these types of files
			$destination = $destination_foto; // where our files will be stored
			$file = $file_foto;
			$filename = explode(".", $file["name"]); 
			$file_name = $file['name']; // file original name
			$file_name_no_ext = isset($filename[0]) ? $filename[0] : null; // File name without the extension
			$file_extension = $filename[count($filename)-1];
			$file_weight = $file['size'];
			$file_type = $file['type'];
			// If there is no error
			if( $file['error'] == 0 ){
				// check if the extension is accepted
				if( in_array(strtolower($file_extension), $ok_ext)){
					// check if the size is not beyond expected size
					// rename the file
					$fileNewName = str_replace(" ","_",strtolower($nama_foto)).'.'.$file_extension ;
					// and move it to the destination folder
					if( move_uploaded_file($file['tmp_name'], $destination.$fileNewName) ){
						$foto_path = $destination.$fileNewName;
						return "true-".$foto_path;
					}else{
						return "false-gagal menyimpan file yang anda upload, terjadi kesalahan saat upload";					
					}
				}else{
					return "false-eksentsi file yang anda pakai tidak didukung, silahkan upload dengan ekstensi jpg,png,jpeg";
				}
			}else{
				return "false-Batas maksimal upload 2MB";
			}

	}
	function finishCheckout(){
		global $mysqli;
		$_SESSION['order_invoice'] = generate_trans_invoice();
		$_SESSION['order_code'] = generate_trans_code();
		$id_users = $_SESSION['login_id'];
		$invoice = $_SESSION['order_invoice'];
		$subtotal = $_SESSION['order_subtotal']+$_SESSION['order_code'];
		$alamat_pengiriman = $_SESSION['order_alamat'];
		$ongkos_kirim = $_SESSION['order_ongkir'];
		$metode_pengiriman = $_SESSION['order_pengiriman'];
		$catatan = $_SESSION['order_catatan'];
		$last_edit = date("Y-m-d H:i:s");
		for($i=0;$i<count($_SESSION['order_produk']);$i++){
			$getProduk = getDataByCollumn("tbl_produk","nama_produk",$_SESSION['order_produk'][$i])->fetch_object();
			$id_produk = $getProduk->id_produk;
			$qty = $_SESSION['order_qty'][$i];
			$sql_transaksi = "INSERT INTO tbl_transaksi(id_users,id_produk,invoice,qty,subtotal,alamat_pengiriman,ongkos_kirim,metode_pengiriman,catatan,status_transaksi,last_edit)
				VALUES($id_users,$id_produk,'$invoice',$qty,$subtotal,'$alamat_pengiriman',$ongkos_kirim,'$metode_pengiriman','$catatan','pending','$last_edit')";
			$stmt = $mysqli->query($sql_transaksi);
		}
		if($stmt){
			echo'
				<div class="alert alert-success" role="alert">
					<center>TRANSAKSI DENGAN INVOICE '.$invoice.' TELAH BERHASIL, SILAHKAN LAKUKAN PEMBAYARAN</center>
				</div>
			';
			$transaksi = getDataByCollumn("tbl_transaksi","invoice",$invoice)->fetch_object();
			$id_transaksi = $transaksi->id_transaksi;
			$mysqli->query("insert into tbl_transaksi_pembayaran(id_transaksi,metode_pembayaran,pemilik_bank,nama_bank,rekening_bank,tanggal_dibayar,total_dibayar,bukti_pembayaran) 
				VALUES($id_transaksi,'BANK TRANSFER','','','','','','')");
		}else{
			echo'
				<div class="alert alert-danger" role="alert">
					<center>TRANSAKSI DENGAN INVOICE '.$invoice.' TIDAK DAPAT DILAKUKAN, SILAHKAN COBA LAGI NANTI</center>
				</div>
			';
			$mysqli->query("delete from tbl_transaksi where invoice='$invoice'");
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>