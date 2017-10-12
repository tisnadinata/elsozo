<?php
	session_start();
	$mysqli = new mysqli("mysql.hostinger.co.id","u656899135_elszo","Elsozo27","u656899135_elszo");
	
	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	function getPengaturan($nama_pengaturan){
		global $mysqli;
		$stmt = getDataByCollumn("tbl_pengaturan","nama_pengaturan",$nama_pengaturan);
		if($stmt->num_rows > 0){
			return $stmt->fetch_object();
		}else{
			return 0;
		}
	}
	
	function getDataByCollumn($table_name,$field_name,$value){
		global $mysqli;
		$stmt = $mysqli->query("select * from $table_name where $field_name='$value'");
		return $stmt;		
	}
	function getDataByCondition($table_name,$condition,$order_by){		
		global $mysqli;
		$stmt = $mysqli->query("select * from $table_name where $condition order by $order_by");
		return $stmt;
	}
	function getDataTable($table_name,$order_by){		
		global $mysqli;
		$stmt = $mysqli->query("select * from $table_name order by $order_by");
		return $stmt;
	}
?>