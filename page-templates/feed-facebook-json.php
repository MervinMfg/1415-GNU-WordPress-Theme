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
	$fbAccessToken = file_get_contents('https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id=' . $clientId . '&client_secret=' . $clientSecret);
	// get the facebook posts
	$fbPosts = file_get_contents('https://graph.facebook.com/' . $_GET["username"] . '/posts?fields=type,from,link,created_time,picture,likes,message&limit=' . $limit . '&' . $fbAccessToken);
	echo $fbPosts;
} else {
	header('Location: /');
}
?>