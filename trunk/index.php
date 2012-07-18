<?php
define("allow entry", 1);
$file;
$function;
if (!isset($_REQUEST["action"])) {
	$file = "disclaimer.php";
	$function = "showTerms";
} else {
	$actionArray = array(
		'login' => array('loginattempt.php', 'loginAuthenticate'),
		'namecheck' => array('register.php', 'nameCheck'),
		'regform' => array('register.php', 'registerForm'),
		'regsubmit' => array('register.php', 'doRegister'),
		'about' => array('disclaimer.php', 'showAbout'),
		'letsbefriends' => array('disclaimer.php', 'showLetsBeFriends'),
		'ad' => array('ad.php', 'showAd')
	);

	if (array_key_exists($_REQUEST["action"], $actionArray)) {
		$file = $actionArray[$_REQUEST["action"]][0];
		$function = $actionArray[$_REQUEST["action"]][1];
	} else {
		require('hackingattempt.php');
	}
}
require_once($file);
call_user_func($function);
?>