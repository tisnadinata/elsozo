<?php
	include '../config/config_db.php';
	define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
	require_once __DIR__ . '/facebook-sdk-v5/autoload.php';
	ini_set('display_errors',1);
  $fb = new Facebook\Facebook([
	'app_id' => "2006311336269832",
	'app_secret' => "e6273aef96d5a1a4ebe6d6ad426f3cdb",
	'default_graph_version' => 'v2.9',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

$expired_token = ($accessToken->getExpiresat()->format('Y-m-d H:i:s'));


// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId("2006311336269832"); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken);
}

$_SESSION['fb_access_token'] = (string) $accessToken;
$fb->setDefaultAccessToken($_SESSION['fb_access_token']);

try {
  $response = $fb->get('/me?fields=id,name,email,picture.width(300)');
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$stmt = $mysqli->query("select * from tbl_users where email = '".$userNode->getField('email')."' OR facebook_id = '".$userNode->getField('id')."'");
if($stmt->num_rows == 0 ){
		$display_name = $userNode->getName();
		$telepon= 0;
		if($userNode->getField('email') != ''){
			$email= $userNode->getField('email');
		}else{
			$email= "";
		}
		$picture= $userNode->getField('picture')['url'];
		$facebook_id= $userNode->getField('id');
		$facebook_token= $accessToken->getValue();
	
	$sql = "insert into tbl_users(display_name,telepon,email,picture,facebook_id,facebook_token) 
		values('$display_name','$telepon','$email','$picture','$facebook_id','$facebook_token')";
	$stmt = $mysqli->query($sql);
	if($stmt){
		$stmt = $mysqli->query("select * from tbl_users where email = '".$userNode->getField('email')."' OR facebook_id = '".$facebook_id."'")->fetch_object();
		$_SESSION['login_id'] = $stmt->id_users;
		$_SESSION['display_name'] =  $stmt->display_name;
		$_SESSION['telepon'] =  $stmt->telepon;
		$_SESSION['email'] =  $stmt->email;
		
		header('Location: '.getPengaturan("url_website")->value.'/order');
	}else{
		echo $sql;
	}
}else{
	$stmt = $stmt->fetch_object();
	$sql = "update tbl_users set facebook_id='".$userNode->getField('id')."',facebook_token='".$accessToken->getValue()."' where id_users=".$stmt->id_users."')";			
	$mysqli->query($sql);
	$_SESSION['login_id'] = $stmt->id_users;
	$_SESSION['display_name'] =  $stmt->display_name;
	$_SESSION['telepon'] =  $stmt->telepon;
	$_SESSION['email'] =  $stmt->email;
	header('Location: '.getPengaturan("url_website")->value.'/order');
}

?>