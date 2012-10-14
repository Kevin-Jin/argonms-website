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

/**
 * 
 *
 * @author GoldenKevin
 */

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'argonms';

$rates = array(
	"1" => array(
		"Exp" => 1,
		"Meso" => 1,
		"Drop" => 1
	)
);

$timezone = new DateTimeZone('America/Los_Angeles');

$login_server_ip = 'localhost';

$portal_path = '/index.php';
?>