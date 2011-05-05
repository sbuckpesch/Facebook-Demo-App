<div style="clear:both;"></div>
<script src="http://connect.facebook.net/de_DE/all.js"></script>
<script>
   FB.init({
     appId  : '<?=$global->instance['fb_app_id']?>',
     status : true, // check login status
     cookie : true, // enable cookies to allow the server to access the session
     xfbml  : true  // parse XFBML
   });
   FB.Canvas.setAutoResize();
</script>
</body>
</html>
