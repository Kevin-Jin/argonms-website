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
class pjtbLogoutPage extends pjtbBasePage {
	private $timeout;
	private $message;
	private $url;

	public function __construct() {
		if (!isset($_SESSION['logged_in_account_id']))
			require_once('hackingattempt.php');

		unset($_SESSION['logged_in_account_id']);

		require_once('config.php');
		$this->timeout = 3;
		$this->message = "You have been logged out. You will be brought to the front page";
		$this->url = config::$portal_path . "?revealed";
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
