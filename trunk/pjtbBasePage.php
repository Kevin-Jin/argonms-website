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
abstract class pjtbBasePage {
	protected abstract function getTitle();

	protected abstract function getBodyContent();

	protected function getHtmlHeader() {
		$title = $this->getTitle();
		return
<<<EOD
<meta http-equiv="Content-Type" content="text/html;charset=us-ascii" />
<title>{$title}</title>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="common.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script type="text/javascript" src="common.js"></script>
EOD;
	}

	protected function getPageHeader() {
		return "";
	}

	protected function getPageBody() {
		$content = $this->getBodyContent();
		return
<<<EOD
<div class="body">
{$content}
</div>

EOD;
	}

	protected function getPageFooter() {
		return
<<<EOD
<div class="footer">
<p>&copy; 2012 Project Throwback. All Rights Reserved.</p>
<p>MapleStory is a registered trademark of NEXON Corporation. It is used on this web site under nominative fair use.</p>
<p>Disclaimer: The owner and operators of this web site do not engage in illegal activities, nor do they know any individuals who do. This web site is intended to serve a web management interface to users and testers of a service developed for educational purposes, to inform the aforementioned users and testers of any news related to said service, and to accept ex gratia donations for said service.</p>
</div>
</div>
EOD;
	}

	protected function getHtmlBody() {
		return $this->getPageHeader() . $this->getPageBody() . $this->getPageFooter();
	}

	public final function getHtml() {
		$header = $this->getHtmlHeader();
		$body = $this->getHtmlBody();
		return
<<<EOD
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
{$header}
</head>
<body>
{$body}
</body>
</html>
EOD;
	}
}
?>
