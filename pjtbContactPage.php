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
class pjtbContactPage extends pjtbBasePage {
	protected function getBodyContent() {
		return
<<<EOD
<strong><em>This page is under construction!</em></strong>
<p>If you are a representative of Nexon, please read <a href="index.php?action=predmca">this statement</a>, prepared by the staff, before serving us a DMCA notice.</p>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>
