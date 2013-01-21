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
class PjtbVotePopup {
	private $id;
	private $url;
	private $text;
	private $reloads;

	public function __construct() {
		if (!isset($_SESSION['loggedInAccountId']) || !isset($_GET["key"]) || !isset($_GET["url"]) || !isset($_GET["text"]) || !isset($_GET["reloads"]))
			require_once('HackingAttempt.php');

		$this->id = $_GET["key"];
		$this->url = $_GET["url"];
		$this->text = $_GET["text"];
		$this->reloads = $_GET["reloads"];

		$spoof = false;
		$token = openssl_random_pseudo_bytes(16);
		$ip = sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
		$currentTimeMillis = round(microtime(true) * 1000);
		require_once('DatabaseManager.php');
		$con = makeDatabaseConnection();
		$ps = $con->prepare("INSERT INTO `websitevotes` (`accountid`,`ip`,`token`,`site`,`expiredate`) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE "
				. "`accountid` = IF(`site` = VALUES(`site`) AND `expiredate` < VALUES(`expiredate`), VALUES(`accountid`), `accountid`), "
				. "`ip` = IF(`site` = VALUES(`site`) AND `expiredate` < VALUES(`expiredate`), VALUES(`ip`), `ip`), "
				. "`token` = IF(`site` = VALUES(`site`) AND `expiredate` < VALUES(`expiredate`), VALUES(`token`), `token`)");
		$ps->bind_param('issii', $_SESSION['loggedInAccountId'], $ip, $token, $this->id, $currentTimeMillis);
		$ps->execute();
		if ($con->affected_rows == 0)
			$spoof = true;
		$ps->close();
		$con->close();

		if ($spoof)
			require_once('HackingAttempt.php');

		$_SESSION['votetoken'] = $token;
	}

	public final function getHtml() {
		return
<<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="EN">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>{$this->text} - Project Throwback Vote Capture</title>
<style type="text/css">
html {
	overflow: auto;
}

html, body, div, iframe {
	margin: 0px;
	padding: 0px;
	height: 100%;
	border: none;
}

iframe {
	display: block;
	width: 100%;
	border: none;
	overflow-y: auto;
	overflow-x: hidden;
}
</style>
<script type="text/javascript">
// <![CDATA[
var NEEDED_RELOADS = {$this->reloads};
var reloadedCount = 0;

function notify() {
	window.opener.completedVote({$this->id}, "{$this->text}");
	window.close();
}

function reloaded() {
	reloadedCount++;
	if (reloadedCount == NEEDED_RELOADS)
		notify();
}

window.onbeforeunload = function() {
	window.opener.resetButton({$this->id});
};
// ]]>
</script>
</head>
<body>
<iframe id="votesite" src="{$this->url}" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" scrolling="auto" onload="reloaded();"></iframe>
</body>
</html>
EOD;
	}
}
?>
