<?php
// Load all config values and necessary classes
require_once ('init.php');
?>
<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- Include CSS-Files -->
<link href="lib/jFormer/jformer.css" rel="stylesheet" type="text/css" />
<link href="lib/Facebox/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<style type="text/css"><?=$session->design['base_style']?></style>

<!-- Include Javascript-Files -->
<script src="lib/AA/js/aa_fb_framework.js?12" type="text/javascript"></script>
<script src="lib/jquery/jquery-1.6.min.js" type="text/javascript"></script>
<script src="lib/jFormer/jFormer.js" type="text/javascript"></script>
<script src="lib/Facebox/src/facebox.js" type="text/javascript"></script>

<!-- Meta Data -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<?php // No Fan Content (User who are not Fan of the Page see)
	if ($session->fb_page['liked'] == 0) { ?>
		<div class="page_non_fans_layer"> 
			<div style="position:absolute; top:50px; left:150px;">
					<?=$session->content['img_non_fans']?>
			</div>
		</div>		
	<?php }

include 'welcome.php';

// Include Footer Part
include 'footer.php';
?>