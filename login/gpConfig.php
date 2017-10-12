<?php
session_start();

//Include Google client library 
include_once 'google-sdk/src/Google_Client.php';
include_once 'google-sdk/src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '350482313384-8es8m43j1qdocd3encddghcf23e8jo4m.apps.googleusercontent.com';
$clientSecret = '407no1aYLka7ckwqRjzVTnu3';
$redirectURL = 'http://elsozo.com/login';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to ELSOZO');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>