<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
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
<!-- Facebook Meta Data -->
<meta property="og:title" content="<?=$session->config['share_facebook_name']?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=$session->fb_page['app_url']?>" />
<meta property="og:image" content="<?=$session->config['share_facebook_picture']?>" />
<meta property="og:site_name" content="<?=$session->config['share_facebook_caption']?>" />
<meta property="og:description" content="<?=$session->config['share_facebook_desc']?>" />
</head>

<body>
	<?php // No Fan Content (User who are not Fan of the Page see)
	if ($session->fb_page['liked'] == 0) { ?>
		<div class="page_non_fans_layer"> 
			<div style="position:absolute; top:50px; left:150px;">
					<?=$session->content['img_non_fans']?>
			</div>
		</div>		
	<?php } ?>
	
	<div id="header">
		<div id="logo">
			<a href="<?=$session->instance['fb_page_url']?>"><?=$session->content['img_logo']?></a>
		</div>
		<!--	Navigation -->
		<div class="fix" id="nav">
			<ul class="fix homebutton">
				<li class="page_item navfirst">
					<a style="background-image: url('images/home-icon-trans.png');" title="Home" href="<?=$session->fb_page['app_url']?>" target="_top" class="home">
						Pinnwand	
					</a>
				</li>
			</ul>
			<div class="mnav dropdown fix">
				<ul>
					<li class="page_item page-item-12">
						<a title="Meine Lose" href="tickets.php">Meine Lose</a>
					</li>
					<li class="page_item page-item-5">
						<a title="Freunde einladen" href="invite.php">Freunde einladen</a>
					</li>
					<li class="page_item page-item-2">
						<a title="Teilnahmebedigungen" href="terms_and_conditions.php">Teilnahmebedigungen</a>
					</li>
					<li class="page_item page-item-2">
						<a title="Gewinner" href="winner.php">Gewinner</a>
					</li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>