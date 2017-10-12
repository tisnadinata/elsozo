<?php
	include_once '../config/config_modul.php';
	
	
	if(isset($_POST['ongkir_provinsi'])){
		$province = explode("-",$_POST['ongkir_provinsi']);
		$_SESSION['ongkir_provinsi'] = $province[1];
		$json = json_decode(file_get_contents("http://api.rajaongkir.com/starter/city?key=eb153f83729347ff96ac2e7c8f2a3469&province=$province[0]"));
		$json = ($json->rajaongkir);
		echo "<option>Pilih Kota/Kabupaten</option>";
		for($i = 0;$i<count($json->results);$i++){
			?>
				<option value="<?php echo $json->results[$i]->city_id.'-'.$json->results[$i]->type.' '.$json->results[$i]->city_name;?>"><?php echo $json->results[$i]->type.' '.$json->results[$i]->city_name;?></option>		
			<?php		
		}
	}
	if(isset($_POST['ongkir_kota'])){
		$kota = explode("-",$_POST['ongkir_kota']);
		$_SESSION['ongkir_kota'] = $kota[1];
		$json = json_decode(file_get_contents("http://api.rajaongkir.com/starter/city?key=eb153f83729347ff96ac2e7c8f2a3469&id=$kota[0]"));
		$json = ($json->rajaongkir);
		echo $json->results->postal_code;		
	}
	if(isset($_POST['ongkir_layanan'])){
		$kota = explode("-",$_POST['ongkir_layanan']);
		
		echo "<option>Pilih Ekspedisi</option>";
		$json =getJson($kota[0],"jne");
		for($i=0;$i<count($json->rajaongkir->results[0]->costs);$i++){
			$result = $json->rajaongkir->results[0]->costs[$i];
			$cost = $result->cost[0];
			$option = strtoupper($json->rajaongkir->results[0]->code).' - '.$result->service.' - Rp'.setHargaRupiah($cost->value).'/1kg';
			?>	
				<option value="<?php echo strtoupper($json->rajaongkir->results[0]->code).'-'.$result->service.'-'.$cost->value;?>"><?php echo $option?></option>		
			<?php		
		}
		$json =getJson($kota[0],"tiki");
		for($i=0;$i<count($json->rajaongkir->results[0]->costs);$i++){
			$result = $json->rajaongkir->results[0]->costs[$i];
			$cost = $result->cost[0];
			$option = strtoupper($json->rajaongkir->results[0]->code).' - '.$result->service.' - Rp'.setHargaRupiah($cost->value).'/1kg';
			?>	
				<option value="<?php echo strtoupper($json->rajaongkir->results[0]->code).'-'.$result->service.'-'.$cost->value;?>"><?php echo $option?></option>		
			<?php	
		}
		$json =getJson($kota[0],"pos");
		for($i=0;$i<count($json->rajaongkir->results[0]->costs);$i++){
			$result = $json->rajaongkir->results[0]->costs[$i];
			$cost = $result->cost[0];
			$option = strtoupper($json->rajaongkir->results[0]->code).' - '.$result->service.' - Rp'.setHargaRupiah($cost->value).'/1kg';
			?>	
				<option value="<?php echo strtoupper($json->rajaongkir->results[0]->code).'-'.$result->service.'-'.$cost->value;?>"><?php echo $option?></option>		
			<?php		
		}
	}
	function getJson($kota,$courier){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=151&destination=".$kota."&weight=1000&courier=".$courier,
		  CURLOPT_HTTPHEADER => array(
			"content-type: application/x-www-form-urlencoded",
			"key: eb153f83729347ff96ac2e7c8f2a3469"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($err) {
		  $response = "cURL Error #:" . $err;
		} else {
		  $response = json_decode($response);
		}		
		return $response;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>