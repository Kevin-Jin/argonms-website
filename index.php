<?php
define("allow entry", 1);

session_start();
if (!isset($_SESSION['visited'])) {
	//increment hit counter
	$_SESSION['visited'] = true;

	require_once('databasemanager.php');
	$con = makeDatabaseConnection();

	require('config.php');
	$now = new DateTime(NULL, $timezone);
	$now = $now->format("Y-m-d");
	$ps = $con->prepare("INSERT INTO `websitestats` (`day`,`uniquesessions`) VALUES (?,1) ON DUPLICATE KEY UPDATE `uniquesessions` = `uniquesessions` + 1");
	$ps->bind_param('s', $now);
	$ps->execute();
	$ps->close();

	$con->close();
}

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
		'ad' => array('ad.php', 'showAd'),
		'ranking' => array('ranking.php', 'showRanking'),
		'status' => array('ranking.php', 'showStatus'),
		'graph' => array('ranking.php', 'showGraph')
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