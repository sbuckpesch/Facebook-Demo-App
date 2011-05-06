<?php
// Load all config values and necessary classes
require_once ('init.php');
// Include Header Part
include 'header.php';

/*
 * Integrate a Content from App-Arena App-Manager
 * Three-Arrays of Content-Elements are available
 * 1. $global->app['content'] 	--> All content elements
 * 2. $global->app['config'] 	--> All configuration values  
 * 3. $global->app['content']	--> All Design elements
 * The name in the second bracket is the "identifier" which has been setup in App-Manager. 
 */
$global->app['content']['content_test'];

// To show all available data just uncomment the following line
echo '<pre>', print_r($global->app), '</pre>';

// Include Footer Part
include 'footer.php';
?>