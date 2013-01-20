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
class Config {
	private static $CFG_FILE = 'config.ini';

	public $dbHost;
	public $dbUser;
	public $dbPass;
	public $dbName;
	public $rates;
	public $timeZone;
	public $loginServerIp;
	public $portalPath;

	private function __construct($configFile) {
		$props = parse_ini_file($configFile, true);
		$this->dbHost = $props['dbhost'];
		$this->dbUser = $props['dbuser'];
		$this->dbPass = $props['dbpass'];
		$this->dbName = $props['dbname'];
		$this->rates = $props['rates'];
		$this->timeZone = $props['timezone'];
		$this->loginServerIp = $props['loginserverip'];
		$this->portalPath = $props['portalpath'];
	}

	private static $instance;

	public static function getInstance() {
		if (self::$instance == null)
			self::$instance = new Config(self::$CFG_FILE);
		return self::$instance;
	}
}
?>