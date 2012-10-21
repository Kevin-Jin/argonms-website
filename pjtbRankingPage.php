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

require_once("pjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class pjtbRankingPage extends pjtbBasePage {
	protected function getHtmlHeader() {
		return parent::getHtmlHeader() .
<<<EOD

<style type="text/css">
table#ranking {
	margin-left: auto;
	margin-right: auto;
}
table#ranking td {
	border: 1px solid #000;
	margin: 0;
	text-align: center;
}
</style>
EOD;
	}

	protected function getBodyContent() {
		$min = 1;
		$max = 10;
		$content = "<table id=\"ranking\">\n<tr><td>Position</td><td>Name</td><td>World</td><td>Job</td><td>Level</td><td>Exp</td></tr>\n";
		require_once('databasemanager.php');
		$con = makeDatabaseConnection();
		$ps = $con->prepare("CALL fetchranks('overall', null, ?, ?)");
		$ps->bind_param('dd', $min, $max);
		if ($ps->execute()) {
			$rs = $ps->get_result();
			while ($array = $rs->fetch_array())
				$content .= "<tr><td>" . $array[0] . "</td><td>" . $array[2] . "</td><td>" . $array[3] . "</td><td>" . $array[4] . "</td><td>" . $array[5] . "</td><td>" . $array[6] . "</td></tr>\n";
			$rs->close();
		}
		$ps->close();
		$con->close();
		$content .= "</table>";
		return $content;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>
