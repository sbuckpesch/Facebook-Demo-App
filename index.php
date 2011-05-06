<?php
// Load all config values and necessary classes
require_once ('init.php');

// Include Header Part
include 'header.php';
?>

<h1>App-Arena Demo Applikation</h1>

<p>
Klick dich durch die Applikation und sehe was du nun alles kannst.
</p>

<p>Config-Value <?=$global->app['config']['config_test']?></p>


<?php 
// Include Footer Part
include 'footer.php';
?>