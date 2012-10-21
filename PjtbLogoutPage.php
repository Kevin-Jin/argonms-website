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
class PjtbLogoutPage extends PjtbBasePage {
	private $timeout;
	private $message;
	private $url;

	public function __construct() {
		if (!isset($_SESSION['loggedInAccountId']))
			require_once('HackingAttempt.php');

		unset($_SESSION['loggedInAccountId']);
		if (isset($_COOKIE['auth'])) {
			require_once('LoginFunctions.php');
			destroyCookie();
		}

		require_once('Config.php');
		$this->timeout = 3;
		$this->message = "You have been logged out. You will be brought to the front page";
		$this->url = Config::getInstance()->portalPath . "?revealed";
	}

	protected function getHtmlHeader() {
		return parent::getHtmlHeader() . "\n<meta http-equiv=\"Refresh\" content=\"{$this->timeout}; {$this->url}\">";
	}

	protected function getBodyContent() {
		return "<p>{$this->message} momentarily (or click <a href=\"{$this->url}\">here</a> to do so immediately).</p>";
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>
