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
class PjtbLoginSubmitPage extends PjtbBasePage {
	private $timeout;
	private $message;
	private $url;

	public function __construct() {
		if (!isset($_POST["username"]) || !isset($_POST["password"]))
			require_once('HackingAttempt.php');

		require_once('DatabaseManager.php');
		$con = makeDatabaseConnection();
		$ps = $con->prepare("SELECT `id`,`password`,`salt` FROM `accounts` WHERE `name` = ?");
		$ps->bind_param('s', $_POST["username"]);
		if ($ps->execute()) {
			$rs = $ps->get_result();
			if ($array = $rs->fetch_array()) {
				require_once('HashFunctions.php');
				$correct = false;
				$hasSalt = isset($array[2]);
				switch (strlen($array[1])) {
					case 20: //sha-1 (160 bits = 20 bytes)
						$correct = $hasSalt && checkSaltedSha1Hash($array[1], $_POST["password"], $array[2]) || !$hasSalt && checkSha1Hash($array[1], $_POST["password"]);
						//only update to SHA512 w/ salt if we are sure the given password matches the SHA1 hash
						$hashUpdate = $correct;
						break;
					case 64: //sha-512 (512 bits = 64 bytes)
						$correct = $hasSalt && checkSaltedSha512Hash($array[1], $_POST["password"], $array[2]) || !$hasSalt && checkSha512Hash($array[1], $_POST["password"]);
						//only update to SHA512 w/ salt if we are sure the given password matches and we don't already have a salt
						$hashUpdate = $correct && !$hasSalt;
						break;
					case 5:
					case 6:
					case 7:
					case 8:
					case 9:
					case 10:
					case 11:
					case 12: //plaintext - client only sends password (5 <= chars <= 12)
						$correct = $array[1] == $_POST["password"];
						//only update to SHA512 w/ salt if we are sure the given password matches the plaintext
						$hashUpdate = $correct;
						break;
					default:
						$correct = false;
						//don't update to SHA512 w/ salt if we can't verify the given password
						$hashUpdate = false;
						break;
				}
				if ($correct) {
					if ($hashUpdate) {
						$ps->close();
						$salt = makeSalt();
						$passhash = makeSaltedSha512Hash($_POST["password"], $salt);
						$ps = $con->prepare("UPDATE `accounts` SET `password` = ?, `salt` = ? WHERE `id` = ?");
						$ps->bind_param('ssi', $passhash, $salt, $array[0]);
						$ps->execute();
					}

					$_SESSION['loggedInAccountId'] = $array[0];
					if (isset($_POST["persistent"])) {
						require_once('LoginFunctions.php');
						createNewCookie($con);
					}

					require_once('Config.php');
					$this->timeout = 3;
					$this->message = "You have successfully logged in. You will be brought to your account's control panel";
					$this->url = Config::getInstance()->portalPath . "?action=cp";
				} else {
					require_once('Config.php');
					$this->timeout = 3;
					$this->message = "That password is incorrect. You will be brought back to the last page";
					$this->url = Config::getInstance()->portalPath . "?action=loginform";
				}
			} else {
				require_once('Config.php');
				$this->timeout = 3;
				$this->message = "That username is incorrect. You will be brought back to the last page";
				$this->url = Config::getInstance()->portalPath . "?action=loginform";
			}
			$rs->close();
		}
		$ps->close();
		$con->close();
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
