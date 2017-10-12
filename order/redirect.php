<?php
	include_once '../config/config_modul.php';
	session_start();
	session_destroy();
	
	header("location:".getPengaturan("url_website")->value);;
?>