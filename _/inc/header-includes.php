<?php
    // Figure out what our server name is
    $host = $_SERVER['SERVER_NAME'];
    // check if we are in the dev environment
    if ($host == 'localhost' || $host == 'gnu.dev' || $host == 'gnu1415.staging.wpengine.com') {
        // we're on dev, so include the dev CSS file and JavaScript individually for easier debugging
        echo '<link href="' . get_template_directory_uri() . '/_/css/gnu.main.css" rel="stylesheet" type="text/css" />' . "\n";
        include 'header-scripts.php';
    } else {
        // if production, provide the minified CSS and compiled/uglified JavaScript files
        echo '<link href="' . get_template_directory_uri() . '/_/css/gnu.main.min.css" rel="stylesheet" type="text/css" />' . "\n\t";
        echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/_/js/gnu.header.min.js"></script>' . "\n";
    }
?>