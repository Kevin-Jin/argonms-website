<?php
function showRanking() {
	$min = 1;
	$max = 10;
	echo "<table><tr><td>Position</td><td>Name</td><td>World</td><td>Job</td><td>Level</td><td>Exp</td></tr>\n";
	require_once('databasemanager.php');
	$con = makeDatabaseConnection();
	$ps = $con->prepare("CALL fetchranks('overall', null, ?, ?)");
	$ps->bind_param('dd', $min, $max);
	if ($ps->execute()) {
		$rs = $ps->get_result();
		while ($array = $rs->fetch_array())
			echo "<tr><td>" . $array[0] . "</td><td>" . $array[2] . "</td><td>" . $array[3] . "</td><td>" . $array[4] . "</td><td>" . $array[5] . "</td><td>" . $array[6] . "</td></tr>\n";
	}
	$ps->close();
	$con->close();
	echo "</table>";
}

function showStatus() {
	$host = "pjtb.net";
	$login_server_port = 8484;
	$connection = @fsockopen($host, $login_server_port);
	if ($connection) {
		fclose($connection);
		$online = true;
	} else {
		$online = false;
	}
	$onlineCount = 0;
	if ($online) {
		require_once('databasemanager.php');
		$con = makeDatabaseConnection();
		$ps = $con->prepare("SELECT COUNT(*) FROM `accounts` WHERE `connected` <> 0");
		if ($ps->execute()) {
			$ps->bind_result($onlineCount);
			$ps->fetch();
		}
		$ps->close();
		$con->close();
	}
	echo "<p>Login server status: " . ($online ? "online" : "offline") . "</p>\r\n";
	echo "<p>Number of players currently online: " . $onlineCount . "</p>";
}

function showGraph() {
	require_once('databasemanager.php');
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

	echo
<<<EOD
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Project Throwback In Game Population Statistics</title>

		<link rel="stylesheet" type="text/css" href="common.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
	var activeTimes = {
EOD;
	for ($i = 0; $i < $entries; $i++)
		echo $day[$i]->format("'n/j/y':'g:i:s A T'") . ","; // 'M/d/yy':'h:mm:ss a'
	echo
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
		echo $day[0]->format("F j, Y"); //MMMM d, yyyy
	echo
<<<EOD
',
				x: -20
			},
			xAxis: {
				categories: [
EOD;
	for ($i = 0; $i < $entries; $i++)
		echo "'" . $day[$i]->format("n/j/y") . "',"; //M/d/yy
	echo
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
	echo "'Most active time: ' + activeTimes[this.x]";
	echo
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
		echo $max[$i] . ",";
	echo
<<<EOD
]
			}, {
				name: 'Unique Logins',
				data: [
EOD;
	for ($i = 0; $i < $entries; $i++)
		echo $unique[$i] . ",";
	echo
<<<EOD
]
			}]
		});
	});
});
		</script>
		<script src="highcharts.js"></script>
	</head>
	<body>
		<div class="body">
			<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">
				<p>JavaScript must be enabled in order to view this content.</p>
			</div>
		</div>

EOD;
		require_once('common.php');
		showFooter();
		echo
<<<EOD
	</body>
</html>
EOD;
}
?>