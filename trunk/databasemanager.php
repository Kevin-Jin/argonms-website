<?php
if (!defined("allow entry"))
	require('hackingattempt.php');

function makeDatabaseConnection() {
	require_once('config.php');
	return new mysqli('p:'.$dbhost, $dbuser, $dbpass, $dbname);
}
?>