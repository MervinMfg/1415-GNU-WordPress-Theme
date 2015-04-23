<?php
/*
Template Name: Instagram JSON
*/

// REQUEST THE INSTAGRAM POSTS
$clientId = '5fcbe8507f58425d81c9c0d6fccbbbe2';
$clientSecret = '27f03ea749d743e3804ea3d382a6e509';
// ACCESS TOKEN URL
// https://instagram.com/oauth/authorize/?client_id=CLIENT-ID&redirect_uri=REDIRECT-URI&response_type=token
// https://instagram.com/oauth/authorize/?client_id=5fcbe8507f58425d81c9c0d6fccbbbe2&redirect_uri=http://www.gnu.com&response_type=token
$accessToken = '14985997.5fcbe85.874e0380e1134a148581aa298fc31bd8'; // libtechnologies user access token
$limit = 10; // set default limit
if (isset($_GET["limit"])) {
	$limit = $_GET["limit"]; // update limit if declared
}

if (isset($_GET["username"])) {
	header('Content-Type: application/json');
	$userInfo = file_get_contents('https://api.instagram.com/v1/users/search?q=' . $_GET["username"] . '&client_id=' . $clientId);
	$userInfo = json_decode($userInfo);
	$userId = $userInfo->data[0]->id; // grabs the user ID of the first returned username
	$userPhotos = file_get_contents('https://api.instagram.com/v1/users/' .  $userId . '/media/recent?access_token=' . $accessToken . '&count=' . $limit);
	echo $userPhotos;
} else if (isset($_GET["tag"])) {
	header('Content-Type: application/json');
	$clientId = '4c33ba16771a4311948cfafffe58c345'; // libtechnologies user access token
	$taggedPhotos = file_get_contents('https://api.instagram.com/v1/tags/' . $_GET["tag"] . '/media/recent?client_id=' . $clientId . '&count=' . $limit);
	echo $taggedPhotos;
} else {
	header('Location: /');
}
?>
