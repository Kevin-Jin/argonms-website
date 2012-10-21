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
	require_once('hackingattempt.php');

/**
 * 
 *
 * @author GoldenKevin
 */
class pjtbNameCheckPage {
	public final function getHtml() {
		$name = "";

		require_once('databasemanager.php');
		$con = makeDatabaseConnection();
		$ps = $con->prepare("SELECT COUNT(*) FROM `accounts` WHERE `name` = ?");
		$ps->bind_param('s', $_GET["name"]);
		$ps->execute();
		$ps->bind_result($usermatchcount);
		if ($ps->fetch() && $usermatchcount > 0)
			$name = $_GET["name"];
		$ps->close();
		$con->close();

		return $name;
	}
}
?>
