<?php
$i = 1;
$j = 10;
echo "<table>
<tr><td>Position</td><td>Name</td><td>World</td><td>Job</td><td>Level</td><td>Exp</td></tr>\n";
require_once('databasemanager.php');
$con = makeDatabaseConnection();
$ps = $con->prepare("CALL fetchranks('overall', null, ?, ?)");
$ps->bind_param('dd', $i, $j);
if ($ps->execute()) {
	$rs = $ps->get_result();
	while ($array = $rs->fetch_array()) {
		echo "<tr><td>".$array[0]."</td><td>".$array[2]."</td><td>".$array[3]."</td><td>".$array[4]."</td><td>".$array[5]."</td><td>".$array[6]."</td></tr>\n";
	}
}
$ps->close();
$con->close();
echo "</table>";
?>