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
	require_once('HackingAttempt.php');

require_once("PjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class PjtbRatesPage extends PjtbBasePage {
	protected function getHtmlHeader() {
		return parent::getHtmlHeader() .
<<<EOD

<style type="text/css">
table#rates {
	margin-left: auto;
	margin-right: auto;
}
table#rates td {
	border: 1px solid #000;
	margin: 0;
	text-align: center;
}
</style>
EOD;
	}

	protected function getBodyContent() {
		$content =
<<<EOD
<table id="rates">
<tr><td>World</td><td>Exp Rate</td><td>Meso Rate</td><td>Drop Rate</td></tr>

EOD;
require_once('Config.php');
foreach (Config::$rates as $key=>$value)
	$content .= "<tr><td>{$key}</td><td>{$value['Exp']}</td><td>{$value['Meso']}</td><td>{$value['Drop']}</td></tr>";
$content .=
<<<EOD

</table>
<p>Although we strive to be faithful to the classic versions of MapleStory, we do have higher experience, meso, and drop rates than the official server had for v0.62.</p>
<p>One of the reasons why the drop rate is higher is that finding the drop chances for each individual drop of every monster in the game is an imperfect science, so we increased the chance of any item dropping so it's not so obvious when, say Slime Bubbles and Squishy Liquids are equally rare, because they both now drop all the time. We cannot easily extract this info from accurate sources since they are stored only on Nexon's servers and are not distributed to clients in any way. Drop chances are interpolated based on data collected from hours of playing on Nexon's service.</p>
<p>Likewise, meso drop ranges are not freely available to us, so in order for errors to be less perceptible, meso rates have to be increased. Though sites like Hidden-Street.net have player-collected meso ranges available, a web scraping solution will be kludgy as it will have to be updated whenever the site layout is updated and will fail when the site is unavailable. Downloading and processing a webpage is simply too slow for on-demand fetching, and if we were to process all the data at once and store it somewhere locally, Hidden-Street will become suspicious when they notice a huge bandwidth usage for one IP address (this will also waste space for unpopular monsters and monsters that are in the client data but cannot actually be encountered in v0.62).</p>
<p>EXP ranges had to be increased because of these reasons, since it wouldn't make sense for players to collect more items and mesos at a certain level than when they would have on the official v0.62 service. As a result, gameplay is generally accelerated compared to the official service, but is still decently balanced. The official v0.62 service was popularly considered a grindfest anyway, so we made it a bit more tolerable for players used to the faster leveling in post-Big Bang MapleStory and those migrating from other "GMS-like" private servers with comparable rates.</p>
EOD;
		return $content;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>