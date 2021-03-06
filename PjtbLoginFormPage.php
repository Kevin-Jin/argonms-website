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

require_once("PjtbBasePage.php");

/**
 *
 * @author GoldenKevin
 */
class PjtbLoginFormPage extends PjtbBasePage {
	protected function getBodyContent() {
		require_once('Config.php');
		$portalPath = Config::getInstance()->portalPath;
		return
<<<EOD
<form id="loginform" action="{$portalPath}?action=loginsubmit" method="post">
<p>You must log in in order to access your account control panel and other portions of this site.</p>
<p>Username:<input type="text" id="unamefield" name="username" maxlength="12" />Password:<input type="password" id="passwordfield" name="password" maxlength="12" /><input type="checkbox" name="persistent" value="1" />Remember me<input id="loginsubmit" type="submit" value="Login" /></p>
<p>Or click <a href="{$portalPath}?action=regform">here</a> to register.</p>
</form>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>