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

define("allowEntry", true);

/**
 * 
 *
 * @author GoldenKevin
 */

session_start();
if (!isset($_SESSION['visited'])) {
	//increment hit counter
	$_SESSION['visited'] = true;

	require_once('DatabaseManager.php');
	$con = makeDatabaseConnection();

	require_once('Config.php');
	$now = new DateTime(NULL, new DateTimeZone(Config::getInstance()->timeZone));
	$now = $now->format("Y-m-d");
	$ps = $con->prepare("INSERT INTO `websitestats` (`day`,`uniquesessions`) VALUES (?,1) ON DUPLICATE KEY UPDATE `uniquesessions` = `uniquesessions` + 1");
	$ps->bind_param('s', $now);
	$ps->execute();
	$ps->close();

	$con->close();
}
if (!isset($_SESSION['loggedInAccountId']) && isset($_COOKIE['auth'])) {
	require_once('LoginFunctions.php');
	loadCookie();
}

if (!isset($_REQUEST["action"])) {
	$file = "PjtbTermsPage.php";
	$class = "PjtbTermsPage";
} else {
	$actionArray = array(
		'loginform' => array('PjtbLoginFormPage.php', 'PjtbLoginFormPage'),
		'loginsubmit' => array('PjtbLoginSubmitPage.php', 'PjtbLoginSubmitPage'),
		'namecheck' => array('PjtbNameCheckPage.php', 'PjtbNameCheckPage'),
		'regform' => array('PjtbRegistrationFormPage.php', 'PjtbRegistrationFormPage'),
		'regsubmit' => array('PjtbRegistrationSubmitPage.php', 'PjtbRegistrationSubmitPage'),
		'about' => array('PjtbAboutPage.php', 'PjtbAboutPage'),
		'predmca' => array('PjtbFinalStatement.php', 'PjtbFinalStatement'),
		'ad' => array('PjtbAdPage.php', 'PjtbAdPage'),
		'ranking' => array('PjtbRankingPage.php', 'PjtbRankingPage'),
		'status' => array('PjtbStatusPage.php', 'PjtbStatusPage'),
		'activity' => array('PjtbActivityPage.php', 'PjtbActivityPage'),
		'rates' => array('PjtbRatesPage.php', 'PjtbRatesPage'),
		'contact' => array('PjtbContactPage.php', 'PjtbContactPage'),
		'cp' => array('PjtbUserControlPanel.php', 'PjtbUserControlPanel'),
		'logout' => array('PjtbLogoutPage.php', 'PjtbLogoutPage'),
		'staff' => array('PjtbStaffPage.php', 'PjtbStaffPage')
	);

	if (array_key_exists($_REQUEST["action"], $actionArray)) {
		$file = $actionArray[$_REQUEST["action"]][0];
		$class = $actionArray[$_REQUEST["action"]][1];
	} else {
		require_once('HackingAttempt.php');
	}
}

require_once($file);
$instance = new $class();
echo $instance->getHtml();
?>