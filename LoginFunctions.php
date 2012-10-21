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

if (!defined("allow entry"))
	require_once('HackingAttempt.php');

/**
 * 
 *
 * @author GoldenKevin
 */

function loadCookie() {
	$params = explode(':', $_COOKIE['auth']);
	$uid = intval($params[0]);
	$token = $params[1];
	$correct = false;

	require_once('DatabaseManager.php');
	$con = makeDatabaseConnection();
	$ps = $con->prepare("SELECT `accountid`,`tokenhash` FROM `websitecookies` WHERE `uniqueid` = ?");
	$ps->bind_param('i', $uid);
	if ($ps->execute()) {
		$rs = $ps->get_result();
		if ($array = $rs->fetch_array()) {
			require_once('HashFunctions.php');
			$accountid = $array[0];
			$correct = checkSha512Hash($array[1], $token);
		}
		$rs->close();
	}
	$ps->close();

	$ps = $con->prepare("DELETE FROM `websitecookies` WHERE `uniqueid` = ?");
	$ps->bind_param('i', $uid);
	$ps->execute();
	$ps->close();

	if ($correct) {
		$_SESSION['loggedInAccountId'] = $accountid;
		createNewCookie($con);
	}

	$con->close();
}

function createNewCookie($con) {
	$newToken = bin2hex(openssl_random_pseudo_bytes(16));
	$tokenHash = hexSha512($newToken);
	$ps = $con->prepare("INSERT INTO `websitecookies` (`accountid`,`tokenhash`) VALUES (?,?)");
	$ps->bind_param('is', $_SESSION['loggedInAccountId'], $tokenHash);
	$ps->execute();
	$uid = $con->insert_id;
	$ps->close();

	setcookie('auth', implode(':', array($uid, $newToken)), time() + 60 * 60 * 24 * 15, '', '', isset($_SERVER["HTTPS"]), true);
}

function destroyCookie() {
	$params = explode(':', $_COOKIE['auth']);
	$uid = intval($params[0]);

	require_once('DatabaseManager.php');
	$con = makeDatabaseConnection();
	$ps = $con->prepare("DELETE FROM `websitecookies` WHERE `uniqueid` = ?");
	$ps->bind_param('i', $uid);
	$ps->execute();
	$ps->close();
	$con->close();

	setcookie('auth', '', time() - 60 * 60, '', '', isset($_SERVER["HTTPS"]), true);
}
?>
