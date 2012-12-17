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

if (!defined("allowEntry"))
	require_once('HackingAttempt.php');

require_once("PjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class PjtbStaffPage extends PjtbBasePage {
	protected function getHtmlHeader() {
		return parent::getHtmlHeader() .
<<<EOD

<style type="text/css">
p.description {
	margin-left: 10px;
	font-style: italic;
}
</style>
EOD;
	}

	protected function getBodyContent() {
		return
<<<EOD
<h3>GoldenKevin</h3>
<p class="description">Founder, administrator, director, moderator, accountant, and public relations manager of Project Throwback</p>
<p class="description">Maintainer and lead programmer of ArgonMS</p>
<h3>Viegar</h3>
<p class="description">Event coordinator, gamemaster, and public relations specialist of Project Throwback</p>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>