<?php
$icon_helper = new iCon_Helper($aa_app_id);
$sponsor_fb_page = new AA_Fb_Page($session->config['sponsor_page_id']);
$lottery = new iCon_Lottery($aa_app_id);

// Get referrer if available and save the referrer to the session
$isUserReferred = false;
if (isset($user->request_data['app_data'])){
	$app_data = $icon_helper->getAppDataParams($user->request_data['app_data']);
	$session->tracking['ref_user_id'] = $app_data[1];
	// Fix js-tracking data bug (timestamp has only 10 characters)
	if (strlen($app_data[2]) > 10)
		$app_data[2] = substr($app_data[2], 0, 10);
	$session->tracking['ref_date'] = $app_data[2];
	$ref_user = $user->getUser($app_data[1]);
	$isUserReferred = true;
}
?>
<script type="text/javascript">
<!--

var keyStr = "ABCDEFGHIJKLMNOP" +
			"QRSTUVWXYZabcdef" +
			"ghijklmnopqrstuv" +
            "wxyz0123456789+/" +
            "=;";

function encode64(input) {
    input = escape(input);
    var output = "";
    var chr1, chr2, chr3 = "";
    var enc1, enc2, enc3, enc4 = "";
    var i = 0;

    do {
       chr1 = input.charCodeAt(i++);
       chr2 = input.charCodeAt(i++);
       chr3 = input.charCodeAt(i++);

       enc1 = chr1 >> 2;
       enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
       enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
       enc4 = chr3 & 63;

       if (isNaN(chr2)) {
          enc3 = enc4 = 64;
       } else if (isNaN(chr3)) {
          enc4 = 64;
       }

       output = output +
          keyStr.charAt(enc1) +
          keyStr.charAt(enc2) +
          keyStr.charAt(enc3) +
          keyStr.charAt(enc4);
       chr1 = chr2 = chr3 = "";
       enc1 = enc2 = enc3 = enc4 = "";
    } while (i < input.length);

    return output;
 }

function auth_and_post(){
	var callback_success = function(){
		// Get Facebook Session and create tracking link
		if(FB.getSession() != null) {
			// What happens after a successful wallpost
			var	fct_redirect = function(){
				setTimeout("self.location.href='invite.php'", 5);
			};
			// Get user id
			var fb_user_id;
			var reflink;
			var now = new Date();
			FB.api('/me', function(response) {
				reflink = "<?=$session->fb_page['app_url']?>" + "&app_data=" + encode64(escape('welcome.php;' + response.id + ";" +  now.getTime()));
				fb_post_wall('<?=$session->config['share_facebook_message'];?>', reflink,
						 '<?=$session->config['share_facebook_name'];?>', '<?=$session->config['share_facebook_caption'];?>', 
						 '<?=$session->config['share_facebook_desc'];?>', '<?=$session->config['share_facebook_picture'];?>',
						 fct_redirect,'<?=$session->config['share_facebook_actionname'];?>', reflink);
			});
		};
	};
	fb_auth_user_callback('<?=$session->config['permissions'];?>','display', callback_success);
};
//-->
</script>


<div id="content">

<?php

// Show profile picture of the user which referred the current visitor 
if ($isUserReferred){?>
	<!--<div id="ref_user">
		<span id="ref_user_picture">
			<img src="<?php echo $user->getProfilePictureUrl("small", $session->tracking['ref_user_id']) ?>" />
		</span> 
		<span id="ref_user_name"><?=$ref_user['name']?></span>
	</div>
	--><?php 
}

// Check which page should be shown: page_welcome_pre, page_welcome_live, page_welcome_post
if (strtotime($session->config['app_start_date']) < time() 
	&& time() <strtotime($session->config['app_end_date'])) { ?>
		<!-- Show Live-Page-->
		<div class="welcome_content">
			<?=$session->content['page_welcome_live'];?>
		</div>
		<!-- Integrate Sponsor -->
		<?php if ($session->config['app_sponsor_available']) {?>
			<span class="sponsor_desc"><?=$session->content['sponsor_desc'];?></span>
			<span class="sponsor_image"><?=$session->content['sponsor_image'];?></span>
			<span id="sponsor_like_btn"><fb:like href="<?php echo $sponsor_fb_page->getLink(); ?>" send="false" layout="button_count" width="250" show_faces="false" font="tahoma"></fb:like></span>
		<?php } ?>
		<div class="btn-participate"> 
			<?php if (!$lottery->isUserParticipating()) {?>
				<span class="btn" onclick="auth_and_post();"><?=$session->content['btn_participate']?></span>
			<?php } else {?>
				<span class="btn" onclick="setTimeout(self.location.href='tickets.php', 0);"><?=$session->content['btn_my_tickets']?></span>
			<?php }?>
		</div>
	<?php 
} elseif (time() < strtotime($session->config['app_start_date'])) {
	// Show Pre-Page
	echo $session->content['page_welcome_pre'];
} else {
	// Show Post-Page
	echo $session->content['page_welcome_post'];
}?>
</div>