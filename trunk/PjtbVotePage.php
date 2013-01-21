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
class PjtbVotePage extends PjtbBasePage {
	private $expireDates;
	private $earliestExpire;

	public function __construct() {
		if (!isset($_SESSION['loggedInAccountId']))
			require_once('HackingAttempt.php');

		$ip = sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
		require_once('DatabaseManager.php');
		$con = makeDatabaseConnection();
		$ps = $con->prepare("SELECT `site`,`expiredate` FROM `websitevotes` WHERE `accountid` = ? OR `ip` = ?");
		$ps->bind_param("is", $_SESSION['loggedInAccountId'], $ip);
		if ($ps->execute()) {
			$this->expireDates = array();
			$this->earliestExpire = INF;
			$rs = $ps->get_result();
			while ($array = $rs->fetch_array()) {
				$this->expireDates[$array[0]] = $array[1];
				if ($array[1] < $this->earliestExpire)
					$this->earliestExpire = $array[1];
			}
			$rs->close();
			foreach (Config::getInstance()->voteSites as $key=>$params) {
				if (!array_key_exists($key, $this->expireDates))
					$this->earliestExpire = 0;
			}
			if (is_infinite($this->earliestExpire))
				$this->earliestExpire = 0;
		}
		$ps->close();
		$con->close();
	}

	private function formatTimer($millis) {
		$hours = floor($millis / (60 * 60 * 1000));
		$millis -= $hours * (60 * 60 * 1000);
		$minutes = floor($millis / (60 * 1000));
		if ($minutes < 10)
			$minutes = '0' . $minutes;
		$millis -= $minutes * (60 * 1000);
		$seconds = floor($millis / (1000));
		if ($seconds < 10)
			$seconds = '0' . $seconds;
		return $hours . ":" . $minutes . ":" . $seconds;
	}

	protected function getBodyContent() {
		$now = round(microtime(true) * 1000);

		$remainingCooldown = $this->earliestExpire - $now;
		if ($remainingCooldown > 0)
			$remainingCooldown = "in " . $this->formatTimer($remainingCooldown);
		else
			$remainingCooldown = "now";

		require_once('Config.php');
		$voteReward = Config::getInstance()->voteRewardNx;
		$content =
<<<EOD
<div class="attention">
<p id="notify">You may vote again {$remainingCooldown}!</p>
<p>Each time you vote for us through one of the links below, you will earn {$voteReward} points towards your account's in game cash balance. You may view your current balance in the user control panel.</p>
<p>Note: Do NOT close out of any popup windows or spawned tabs. They will automatically close when our website registers the vote. Otherwise, you will lose a vote opportunity and miss out on the in game cash reward for this period!</p>
<!--[if IE]>
<p>Due to a Internet Explorer security feature, the vote detection function will not work correctly by default on your browser. If you have not done so already, you must open up Internet Options, go to the Privacy tab, slide Settings to Accept All Cookies (the lowest notch), and click OK.</p>
<![endif]-->
EOD;
		foreach (Config::getInstance()->voteSites as $key=>$params) {
			$escapedText = urlencode($params["text"]);
			$escapedVoteUrl = urlencode($params["url"]);
			$remainingCooldown = (array_key_exists($key, $this->expireDates) ? $this->expireDates[$key] : 0) - $now;
			if ($remainingCooldown > 0) {
				$disabled = true;
				$remainingCooldown = "Available in " . $this->formatTimer($remainingCooldown);
			} else {
				$disabled = false;
				$remainingCooldown = "Ready";
			}
			if ($remainingCooldown > 0)
				$remainingCooldown = "Ready";
			$content .= "\n<input id=\"site{$key}\" value=\"{$params["text"]}&#13;&#10;{$remainingCooldown}\" type=\"button\" onclick=\"buttonClicked({$key}, '{$escapedText}', '{$escapedVoteUrl}', {$params["refreshes"]});\"" . ($disabled ? " disabled" : "") . "></input>";
		}
		$content .= "\n</div>";
		return $content;
	}

	protected function getTitle() {
		return "Project Throwback Vote Capture";
	}

	protected function getHtmlHeader() {
		require_once('Config.php');
		$portalPath = Config::getInstance()->portalPath;
		$header = parent::getHtmlHeader() .
<<<EOD

<style type="text/css">
div.attention {
	text-align: center;
}
</style>
<script type="text/javascript">
// <![CDATA[
var done = new Array();
var clicked = new Array();
var expireDates = {

EOD;
		foreach (Config::getInstance()->voteSites as $key=>$params)
			$header .= "	{$key} : " . (array_key_exists($key, $this->expireDates) ? $this->expireDates[$key] : 0) . ",\n";
		if (count(Config::getInstance()->voteSites) > 0)
			$header = substr($header, 0, -2) . "\n";
		$header .=
<<<EOD
};
var text = {

EOD;
		foreach (Config::getInstance()->voteSites as $key=>$params)
			$header .= "	{$key} : \"" . $params["text"] . "\",\n";
		if (count(Config::getInstance()->voteSites) > 0)
			$header = substr($header, 0, -2) . "\n";
		$header .=
<<<EOD
};
var earliestExpire = $this->earliestExpire;

function synchronizeCurrentTime(callback) {
	var start = new Date().getTime();
	$.get("{$portalPath}?action=query&type=time", function(resp) {
		var end = new Date().getTime();
		var ping = end - start;
		var difference = resp - end + ping / 2;
		callback(difference);
	});
}

function formatTimer(millis) {
	var hours = Math.floor(millis / (60 * 60 * 1000));
	millis -= hours * (60 * 60 * 1000);
	var minutes = Math.floor(millis / (60 * 1000));
	if (minutes < 10)
		minutes = '0' + minutes;
	millis -= minutes * (60 * 1000);
	var seconds = Math.floor(millis / (1000));
	if (seconds < 10)
		seconds = '0' + seconds;
	return hours + ":" + minutes + ":" + seconds;
}

function completedVote(key, text) {
	done[key] = true;
	$('#site' + key).attr('disabled', 'true').attr('value', text + '\\r\\nProcessing...');
	$.get("{$portalPath}?action=query&type=vote&key=" + key, function(resp) {
		expireDates[key] = resp;

		var newEarliestExpire = Number.POSITIVE_INFINITY;
		for (key in expireDates)
			if (expireDates[key] < newEarliestExpire)
				newEarliestExpire = expireDates[key];
		earliestExpire = newEarliestExpire;
	});
}

function buttonClicked(key, text, url, reloads) {
	clicked[key] = true;
	$('#site' + key).attr('disabled', 'true');
	window.open('{$portalPath}?action=voter&key=' + key + '&url=' + url + '&text=' + text + '&reloads=' + reloads);
}

function resetButton(key) {
	if (!done[key])
		$('#site' + key).removeAttr('disabled');
}

$(document).ready(function() {
	synchronizeCurrentTime(function(difference) {
		var updateNotify = function() {
			var now = new Date().getTime() - difference;

			var remainingCooldown = earliestExpire - now;
			if (remainingCooldown > 0)
				remainingCooldown = "in " + formatTimer(remainingCooldown);
			else
				remainingCooldown = "now";
			$("#notify").html("You may vote again " + remainingCooldown + "!");

			for (key in expireDates) {
				remainingCooldown = expireDates[key] - now;
				if (remainingCooldown > 0) {
					remainingCooldown = "Available in " + formatTimer(remainingCooldown);
					$('#site' + key).attr('value', text[key] + '\\r\\n' + remainingCooldown);
				} else {
					if (!clicked[key]) {
						$('#site' + key).removeAttr('disabled');
						remainingCooldown = "Ready";
						$('#site' + key).attr('value', text[key] + '\\r\\n' + remainingCooldown);
					}
				}
			}
		};
		updateNotify();
		//update it exactly on the second
		setTimeout(function() {
			updateNotify();
			setInterval(updateNotify, 1000);
		}, 1000 - (new Date().getTime() + difference) % 1000);
	});
});
// ]]>
</script>
EOD;
		return $header;
	}
}
?>