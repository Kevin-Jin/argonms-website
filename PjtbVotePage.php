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
	private $voteSites;

	public function __construct() {
		if (!isset($_SESSION['loggedInAccountId']))
			require_once('HackingAttempt.php');

		$this->voteSites = array(
			array("Gtop100", urlencode("http://www.gtop100.com/in.php?site=75338"), 2),
			array("Ultimate Private Servers", urlencode("http://www.ultimateprivateservers.com/maple-story/index.php?a=in&u=goldenkevin"), 2)
		);
	}

	protected function getBodyContent() {
		$remainingCooldown = "now";

		$content =
<<<EOD
<div class="attention">
<p>You may vote again {$remainingCooldown}!</p>
<p>Note: Do NOT close out of any popup windows or spawned tabs. They will automatically close when our website registers the vote. Otherwise, you may lose the hour's vote opportunity!</p>
<!--[if IE]>
<p>Due to a Internet Explorer security feature, the vote detection function will not work correctly by default on your browser. If you have not done so already, you must open up Internet Options, go to the Privacy tab, slide Settings to Accept All Cookies (the lowest notch), and click OK.</p>
<![endif]-->
EOD;
		foreach ($this->voteSites as $key=>$params) {
			$escapedText = urlencode($params[0]);
			$content .= "\n<input id=\"site{$key}\" value=\"{$params[0]}&#13;&#10;Not done\" type=\"button\" onclick=\"buttonClicked('site{$key}', '{$escapedText}', '{$params[1]}', {$params[2]});\"></input>";
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
		return parent::getHtmlHeader() .
<<<EOD

<style type="text/css">
div.attention {
	text-align: center;
}
</style>
<script type="text/javascript">
// <![CDATA[
function completedVote(key, text) {
	$('#' + key).attr('disabled', 'true').attr('value', text + '\\r\\nDone');
}

function buttonClicked(key, text, url, reloads) {
	window.open('{$portalPath}?action=voter&key=' + key + '&url=' + url + '&text=' + text + '&reloads=' + reloads);
}
// ]]>
</script>
EOD;
	}
}
?>