<?php
/*
 * Project Throwback website
 * Copyright (C) 2012-2013  GoldenKevin
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

if (!defined("allowEntry"))
	require_once('HackingAttempt.php');

/**
 *
 * @author GoldenKevin
 */
class PjtbQueryPage {
	public final function getHtml() {
		switch ($_GET["type"]) {
			case "name": {
				if (!isset($_GET["name"]))
					require_once('HackingAttempt.php');

				$name = "";

				require_once('DatabaseManager.php');
				$con = makeDatabaseConnection();
				$ps = $con->prepare("SELECT COUNT(*) FROM `accounts` WHERE `name` = ?");
				$ps->bind_param('s', $_GET["name"]);
				$ps->execute();
				$ps->bind_result($userMatchCount);
				if ($ps->fetch() && $userMatchCount > 0)
					$name = $_GET["name"];
				$ps->close();
				$con->close();

				return $name;
			}
			case "vote": {
				if (!isset($_SESSION['loggedInAccountId']) || !isset($_SESSION['votetoken']) || !isset($_GET["key"]))
					require_once('HackingAttempt.php');

				require_once('Config.php');
				$spoof = false;
				$ip = sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
				$currentTimeMillis = round(microtime(true) * 1000);
				$expireDate = $currentTimeMillis + Config::getInstance()->voteSites[$_GET["key"]]["period"] * 60 * 60 * 1000;
				require_once('DatabaseManager.php');
				$con = makeDatabaseConnection();
				$ps = $con->prepare("UPDATE `websitevotes` SET `expiredate` = ?, `token` = NULL WHERE `accountid` = ? AND `ip` = ? AND `site` = ? AND `expiredate` < ? AND `token` = ?");
				$ps->bind_param('iisiii', $expireDate, $_SESSION['loggedInAccountId'], $ip, $_GET["key"], $currentTimeMillis, $_SESSION['votetoken']);
				$ps->execute();
				if ($con->affected_rows == 0)
					$spoof = true;
				$ps->close();
				if (!$spoof) {
					require_once('Config.php');
					$ps = $con->prepare("UPDATE `accounts` SET `paypalnx` = `paypalnx` + ? WHERE `id` = ?");
					$ps->bind_param('ii', Config::getInstance()->voteRewardNx, $_SESSION['loggedInAccountId']);
					$ps->execute();
					$ps->close();
				}
				$con->close();

				return $expireDate;
			}
			case "time": {
				return round(microtime(true) * 1000);
			}
		}
	}
}
?>
