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

<p>Config-Element: <?=$global->app['config']['config_test']?></p>
<p>Content-Element: <?=$global->app['content']['content_test']?></p>
<p>Design-Element: not implemented yet</p>


<?php 
// Include Footer Part
include 'footer.php';
?>