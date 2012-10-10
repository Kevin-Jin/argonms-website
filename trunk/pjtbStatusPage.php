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
	require('hackingattempt.php');

require("pjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class pjtbStatusPage extends pjtbBasePage {
	protected function getBodyContent() {
		require('config.php');
		$login_server_port = 8484;
		$connection = @fsockopen($login_server_ip, $login_server_port);
		if ($connection) {
			fclose($connection);
			$online = true;
		} else {
			$online = false;
		}
		$onlineCount = 0;
		if ($online) {
			require('databasemanager.php');
			$con = makeDatabaseConnection();
			$ps = $con->prepare("SELECT COUNT(*) FROM `accounts` WHERE `connected` <> 0");
			if ($ps->execute()) {
				$ps->bind_result($onlineCount);
				$ps->fetch();
			}
			$ps->close();
			$con->close();
		}
		return "<p>Login server status: " . ($online ? "online" : "offline") . "</p>\n"
				. "<p>Number of players currently online: {$onlineCount}</p>";
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>
