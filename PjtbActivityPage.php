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
class PjtbActivityPage extends PjtbBasePage {
	private function getUsersCount() {
		require_once('DatabaseManager.php');
		$con = makeDatabaseConnection();
		$ps = $con->prepare("SELECT COUNT(*) FROM `accounts`");
		if ($ps->execute()) {
			$ps->bind_result($registeredCount);
			$ps->fetch();
		}
		$ps->close();
		$con->close();

		return $registeredCount;
	}

	private function isServerOnline() {
		require_once('Config.php');
		$loginServerPort = 8484;
		$connection = @fsockopen(Config::getInstance()->loginServerIp, $loginServerPort);
		if ($connection) {
			fclose($connection);
			return true;
		} else {
			return false;
		}
	}

	private function getOnlineCount() {
		if (!self::isServerOnline())
			return 0;

		require_once('DatabaseManager.php');
		$con = makeDatabaseConnection();
		$ps = $con->prepare("SELECT COUNT(*) FROM `accounts` WHERE `connected` <> 0");
		if ($ps->execute()) {
			$ps->bind_result($onlineCount);
			$ps->fetch();
		}
		$ps->close();
		$con->close();

		return $onlineCount;
	}

	protected function getBodyContent() {
		$registeredCount = self::getUsersCount();
		$onlineCount = self::getOnlineCount();

		return
<<<EOD
<p>Number of registered players: {$registeredCount}</p>
<p>Number of players currently online: {$onlineCount}</p>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">
<p>JavaScript must be enabled in order to view this content.</p>
</div>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback Activity Records";
	}

	protected function getHtmlHeader() {
		require_once('DatabaseManager.php');
		$points = array();
		$con = makeDatabaseConnection();
		$ps = $con->prepare("SELECT `day`,`uniquelogins`,`maxconcurrentlogins`,`mostactivetime` FROM `dailystats` ORDER BY `day`");
		$highestYValue = 0;
		if ($ps->execute()) {
			$rs = $ps->get_result();

			require_once('Config.php');
			$tz = new DateTimeZone(Config::getInstance()->timeZone);
			for ($first = true; $array = $rs->fetch_array(); $first = false) {
				if ($first) {
					//fill all dates from the first date of population to today
					//with zeros, and overwrite them with any values in the database.
					//this is to fill in any missing dates in the graphs in case
					//the population stayed at 0 that day.

					$period = new DatePeriod(new DateTime($array[0] . " " . $array[3], $tz), new DateInterval("P1D"), new DateTime("tomorrow", $tz));
					foreach ($period as $dt)
						$points[$dt->format("Ymd")] = array($dt, 0, 0);
				}

				//MySQL string representation of dates is yyyy-MM-dd
				//(or Y-m-d in PHP, standardized as ISO 8601)
				$dt = new DateTime($array[0] . " " . $array[3], $tz);
				$points[$dt->format("Ymd")] = array($dt, $array[1], $array[2]);
				if ($array[1] > $highestYValue)
					$highestYValue = $array[1];
				if ($array[2] > $highestYValue)
					$highestYValue = $array[2];
			}
			$rs->close();
		}
		$ps->close();
		$con->close();

		$xAxisTickInterval = max((int) (count($points) / 7), 1);
		$yAxisTickInterval = max((int) ($highestYValue / 10), 1);

		$header = parent::getHtmlHeader();
		$header .=
<<<EOD

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/highcharts/2.3.1/highcharts.js"></script>
<script type="text/javascript">
// <![CDATA[
var activeTimes = {
EOD;
		foreach ($points as $value)
			$header .= $value[0]->format("'n/j/y':'g:i:s A T'") . ","; // 'M/d/yy':'h:mm:ss a'
		if (count($points) > 0)
			$header = substr($header, 0, -1);
		$header .=
<<<EOD
};
$(document).ready(function() {
	new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			type: 'line',
			marginRight: 200,
			marginBottom: 50
		},
		title: {
			text: 'In Game Population',
			x: -20 //center
		},
		subtitle: {
			text: 'Since 
EOD;
		if (count($points) > 0) {
			$first = reset($points);
			$header .= $first[0]->format("F j, Y"); //MMMM d, yyyy
		}
		$header .=
<<<EOD
',
			x: -20
		},
		xAxis: {
			title: {
				text: 'Date'
			},
			categories: [
EOD;
		foreach ($points as $value)
			$header .= "'" . $value[0]->format("n/j/y") . "',"; //M/d/yy
		if (count($points) > 0)
			$header = substr($header, 0, -1);
		$header .=
<<<EOD
],
			tickInterval: {$xAxisTickInterval}
		},
		yAxis: {
			title: {
				text: 'Player Count'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}],
			tickInterval: {$yAxisTickInterval}
		},
		tooltip: {
			formatter: function() {
				return '<b>' + this.x + '</b><br/>' +
					this.series.name + ': '+ this.y + ' player(s)<br/>' +
					'Most active time: ' + (this.y != 0 ? activeTimes[this.x] : 'N/A');
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -10,
			y: 100,
			borderWidth: 0
		},
		series: [{
			name: 'Highest Concurrent Logins',
			data: [
EOD;
		foreach ($points as $value)
			$header .= $value[2] . ",";
		if (count($points) > 0)
			$header = substr($header, 0, -1);
		$header .=
<<<EOD
]
		}, {
			name: 'Unique Logins',
			data: [
EOD;
		foreach ($points as $value)
			$header .= $value[1] . ",";
		if (count($points) > 0)
			$header = substr($header, 0, -1);
		$header .=
<<<EOD
]
		}]
	});
});
// ]]>
</script>
EOD;
		return $header;
	}
}
?>
