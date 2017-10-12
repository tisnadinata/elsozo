<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	//Initialize User class
	$user = new User();
	
	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
	
	//Storing user data into session
	$_SESSION['userData'] = $userData;
	
	//Render facebook profile data
    if(!empty($userData)){
		$_SESSION['login_id'] = $userData['id_users'];
		$_SESSION['display_name'] =  $userData['display_name'];
		$_SESSION['telepon'] =  $userData['telepon'];
		$_SESSION['email'] =  $userData['email'];
		header('Location: ../order');
    }else{
        header('Location: ' . filter_var($redirectURL."", FILTER_SANITIZE_URL));
    }
} else {
	header('Location: ' . filter_var($redirectURL."", FILTER_SANITIZE_URL));
}