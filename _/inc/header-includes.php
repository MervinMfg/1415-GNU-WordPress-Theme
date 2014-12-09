<?php
	// Figure out what our server name is
	$host = $_SERVER['SERVER_NAME'];
	// check if we are in the dev environment
	if ($host == 'localhost' || $host == 'gnu.dev') {
		// we're on dev, so include the dev CSS file and JavaScript individually for easier debugging
		echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/_/compiled/gnu.main.css" />' . "\n";
		include 'header-scripts.php';
	} else if ($host == 'gnu1415.staging.wpengine.com') {
		// we're on dev, so include the dev CSS file and JavaScript individually for easier debugging
		echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/_/css/gnu.main.css" />' . "\n";
		include 'header-scripts.php';
	} else {
		// include script version for file versioning on production environment
		include_once 'script-version.php';
		// if production, provide the minified CSS and compiled/uglified JavaScript files
		echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/_/css/gnu.main.min.css?v=' . $GLOBALS['SCRIPT_VERSION'] . '" />' . "\n\t";
		echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/_/js/gnu.header.min.js?v=' . $GLOBALS['SCRIPT_VERSION'] . '"></script>' . "\n";
	}
?>