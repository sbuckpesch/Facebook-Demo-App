<?php
// Load all config values and necessary classes
require_once ('init.php');
// Include Header Part
include 'header.php';

/*
 * Integrate a Content from App-Arena App-Manager
 * Four Arrays of Content-Elements are available
 * 1. $global->app['instance'] 	--> All Instance Base Data
 * 2. $global->app['content'] 	--> All content elements
 * 3. $global->app['config'] 	--> All configuration values  
 * 4. $global->app['design']	--> All Design elements
 * The name in the second bracket is the "identifier" which has been setup in App-Manager.
 * E.g. echo $global->app['content']['home']; --> shows the App-Manager content-element with the identifier "home" 
 * To show all available data just uncomment the following line 
 */
//echo '<h1>All available App-Arena data</h1><pre>', print_r($global->app), '</pre>';

echo $global->app['content']['home'];

// Include Footer Part
include 'footer.php';
?>