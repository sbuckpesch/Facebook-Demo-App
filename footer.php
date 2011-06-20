<div style="clear:both;"></div>
<?php // Show admin panel, when page admin
	if ($session->fb_page['admin']) { ?>
		<hr />
		<a href="admin.php">Admin-Panel</a>
	<?php } ?>
<div id="fb-root"></div>
<script type="text/javascript">
<!--
window.fbAsyncInit = function() {
 	FB.init({
		appId: '<?=$session->instance['fb_app_id']?>', 
		status: true, 
		cookie: true, 
		xfbml: true
	});
 	FB.Canvas.setAutoResize();
};
(function() {
 var e = document.createElement('script');
 e.type = 'text/javascript';
 e.src = document.location.protocol + '//connect.facebook.net/de_DE/all.js';
 e.async = true;
 document.getElementById('fb-root').appendChild(e);
 }());
//-->
</script>

</body>
</html>
