<?php
/*
 * Project Throwback website
 * Copyright (C) 2012  GoldenKevin
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

define("allow entry", 1);

/**
 * 
 *
 * @author GoldenKevin
 */

session_start();
if (!isset($_SESSION['visited'])) {
	//increment hit counter
	$_SESSION['visited'] = true;

	require_once('databasemanager.php');
	$con = makeDatabaseConnection();

	require_once('config.php');
	$now = new DateTime(NULL, new DateTimeZone(config::$timezone));
	$now = $now->format("Y-m-d");
	$ps = $con->prepare("INSERT INTO `websitestats` (`day`,`uniquesessions`) VALUES (?,1) ON DUPLICATE KEY UPDATE `uniquesessions` = `uniquesessions` + 1");
	$ps->bind_param('s', $now);
	$ps->execute();
	$ps->close();

	$con->close();
}
if (!isset($_SESSION['logged_in_account_id']) && isset($_COOKIE['auth'])) {
	require_once('loginfunctions.php');
	loadCookie();
}

if (!isset($_REQUEST["action"])) {
	$file = "pjtbTermsPage.php";
	$class = "pjtbTermsPage";
} else {
	$actionArray = array(
		'loginform' => array('pjtbLoginFormPage.php', 'pjtbLoginFormPage'),
		'loginsubmit' => array('pjtbLoginSubmitPage.php', 'pjtbLoginSubmitPage'),
		'namecheck' => array('pjtbNameCheckPage.php', 'pjtbNameCheckPage'),
		'regform' => array('pjtbRegistrationFormPage.php', 'pjtbRegistrationFormPage'),
		'regsubmit' => array('pjtbRegistrationSubmitPage.php', 'pjtbRegistrationSubmitPage'),
		'about' => array('pjtbAboutPage.php', 'pjtbAboutPage'),
		'predmca' => array('pjtbFinalStatement.php', 'pjtbFinalStatement'),
		'ad' => array('pjtbAdPage.php', 'pjtbAdPage'),
		'ranking' => array('pjtbRankingPage.php', 'pjtbRankingPage'),
		'status' => array('pjtbStatusPage.php', 'pjtbStatusPage'),
		'graph' => array('pjtbGraphPage.php', 'pjtbGraphPage'),
		'rates' => array('pjtbRatesPage.php', 'pjtbRatesPage'),
		'contact' => array('pjtbContactPage.php', 'pjtbContactPage'),
		'cp' => array('pjtbUserControlPanel.php', 'pjtbUserControlPanel'),
		'logout' => array('pjtbLogoutPage.php', 'pjtbLogoutPage')
	);

	if (array_key_exists($_REQUEST["action"], $actionArray)) {
		$file = $actionArray[$_REQUEST["action"]][0];
		$class = $actionArray[$_REQUEST["action"]][1];
	} else {
		require_once('hackingattempt.php');
	}
}

require_once($file);
$instance = new $class();
echo $instance->getHtml();
?>