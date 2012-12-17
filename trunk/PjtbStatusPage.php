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

if (!defined("allowEntry"))
	require_once('HackingAttempt.php');

require_once("PjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class PjtbStatusPage extends PjtbBasePage {
	protected function getBodyContent() {
		require_once('Config.php');
		$loginServerPort = 8484;
		$connection = @fsockopen(Config::getInstance()->loginServerIp, $loginServerPort);
		if ($connection) {
			fclose($connection);
			$online = true;
		} else {
			$online = false;
		}
		return "<p>Login server status: " . ($online ? "online" : "offline") . "</p>";
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>