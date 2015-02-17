<?php 
/*
Template Name: Facebook JSON
*/
$clientId = '217173258409585';
$clientSecret = '9368a68d37a96eff5df17ceb3260cedf';
$limit = 10; // set default limit
if (isset($_GET["limit"])) {
	$limit = $_GET["limit"]; // update limit if declared
}
if (isset($_GET["username"])) {
	header('Content-Type: application/json');
	// get the access token for the app
	$accessTokenUrl = 'https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id=' . $clientId . '&client_secret=' . $clientSecret;
	$accessToken = file_get_contents($accessTokenUrl);
	// get the facebook posts
	$userPostsUrl = 'https://graph.facebook.com/' . $_GET["username"] . '/posts?fields=type,from,link,created_time,picture,likes,message&limit=' . $limit . '&' . $accessToken;
	$userPosts = @file_get_contents($userPostsUrl);
	if($userPosts === FALSE) {
		echo '{ "status": "error", "message": "Cannot access user data via public graph api. Facebook user must be a page to display feed data." }';
	} else {
		print_r($userPosts);
	}
} else {
	header('Location: /');
}
?>