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
	require('hackingattempt.php');

require("pjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class pjtbGraphPage extends pjtbBasePage {
	protected function getBodyContent() {
		return
<<<EOD
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">
<p>JavaScript must be enabled in order to view this content.</p>
</div>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback In Game Population Statistics";
	}

	protected function getHtmlHeader() {
		require('databasemanager.php');
		$day = array(); //also includes mostactivetime data with date
		$unique = array();
		$max = array();
		$con = makeDatabaseConnection();
		$ps = $con->prepare("SELECT `day`,`uniquelogins`,`maxconcurrentlogins`,`mostactivetime` FROM `dailystats` ORDER BY `day`");
		$entries = 0;
		$highestYValue = 0;
		if ($ps->execute()) {
			$rs = $ps->get_result();

			require('config.php');
			for (; $array = $rs->fetch_array(); $entries++) {
				//MySQL string representation of dates is yyyy-MM-dd
				//(or Y-m-d in PHP, standardized as ISO 8601)
				$day[$entries] = new DateTime($array[0] . " " . $array[3], $timezone);
				$unique[$entries] = $array[1];
				$max[$entries] = $array[2];
				if ($array[1] > $highestYValue)
					$highestYValue = $array[1];
				if ($array[2] > $highestYValue)
					$highestYValue = $array[2];
			}
		}
		$ps->close();
		$con->close();

		$xAxisTickInterval = max((int) ($entries / 7), 1);
		$yAxisTickInterval = max((int) ($highestYValue / 10), 1);

		$header = parent::getHtmlHeader();
		$header .=
<<<EOD

<script type="text/javascript">
// <![CDATA[
$(function () {
	var activeTimes = {
EOD;
	for ($i = 0; $i < $entries; $i++)
		$header .= $day[$i]->format("'n/j/y':'g:i:s A T'") . ","; // 'M/d/yy':'h:mm:ss a'
	$header .=
<<<EOD
};
	var chart;
	$(document).ready(function() {
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container',
				type: 'line',
				marginRight: 200,
				marginBottom: 50
			},
			title: {
				text: 'In Game Population Statistics',
				x: -20 //center
			},
			subtitle: {
				text: 'Since 
EOD;
	if ($entries > 0)
		$header .= $day[0]->format("F j, Y"); //MMMM d, yyyy
	$header .=
<<<EOD
',
				x: -20
			},
			xAxis: {
				categories: [
EOD;
	for ($i = 0; $i < $entries; $i++)
		$header .= "'" . $day[$i]->format("n/j/y") . "',"; //M/d/yy
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
						
EOD;
	$header .= "'Most active time: ' + activeTimes[this.x]";
	$header .=
<<<EOD
;
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
	for ($i = 0; $i < $entries; $i++)
		$header .= $max[$i] . ",";
	$header .=
<<<EOD
]
			}, {
				name: 'Unique Logins',
				data: [
EOD;
	for ($i = 0; $i < $entries; $i++)
		$header .= $unique[$i] . ",";
	$header .=
<<<EOD
]
			}]
		});
	});
});
// ]]>
</script>
<script type="text/javascript" src="highcharts.js"></script>
EOD;
		return $header;
	}
}
?>
