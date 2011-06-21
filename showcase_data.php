<?php
include 'init.php';
include 'header.php';

$cookie = get_facebook_cookie($session->instance['fb_app_id'], $session->instance['fb_app_secret']);
?>

<div id="content">
	<h1>Which data I can get from the App-Arena Session?</h1>
	<h2>Decoded Signed Request ($session-&gt;fb_api)</h2>
	<?php Zend_Debug::dump($session->fb_api, "FB API: "); ?>
	<h2>Fanpage Data ($session-&gt;fb_page)</h2>
	<?php Zend_Debug::dump($session->fb_page, "Page: "); ?>
	<h2>User Data ($session-&gt;user)</h2>
	<?php Zend_Debug::dump($session->user, "User: "); ?>
	<h2>Data about the Instance ($session-&gt;instance)</h2>
	<?php Zend_Debug::dump($session->instance, "Instance: ");?>
	<h2>All config values ($session-&gt;config)</h2>
	<?php Zend_Debug::dump($session->config, "Config: ");?>
	<h2>All the Design data ($session-&gt;design)</h2>
	<?php Zend_Debug::dump($session->design, "Design: ");?>
	<h2>All the content ($session-&gt;content)</h2>
	<?php Zend_Debug::dump($session->content, "Content: ");?>
	<h2>Facebook Cookie</h2>
	<?php Zend_Debug::dump($cookie, "Facebook-Cookie: ");?>
</div>
<?
	//Get Facebook Cookie

	function get_facebook_cookie($app_id, $app_secret) {
			$args = array();
			if (!isset($_COOKIE['fbs_' . $app_id]))
				return NULL;
			parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
			ksort($args);
			$payload = '';
			foreach ($args as $key => $value) {
				if ($key != 'sig') {
					$payload .= $key . '=' . $value;
				}
			}
			if (md5($payload . $app_secret) != $args['sig']) {
				return null;
			}
			return $args;
		}
					

 
include 'footer.php';
?>