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
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="common.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
EOD;
	}

	protected function getPageHeader() {
		require('config.php');

		$topLevelLinks = array();
		$topLevelLinks['Main'] = array($portal_path . '?revealed', 'a', array(
			'Rankings' => $portal_path . '?action=ranking',
			'Graphs' => $portal_path . '?action=graph',
			'Server Status' => $portal_path . '?action=status',
			'Rates' => $portal_path . '?action=rates'
		));
		//TODO: "User" top level menu should have different links if logged in - i.e. Control Panel instead of Log in and Register
		$topLevelLinks['User'] = array($portal_path . '?action=loginform', 'b', array(
			'Log in' => $portal_path . '?action=loginform',
			'Register' => $portal_path . '?action=regform'
		));
		$topLevelLinks['Forum'] = array('/forum', 'c', array());
		$topLevelLinks['About'] = array($portal_path/* . '?action=about'*/, 'd', array(
			//'About' => $portal_path . '?action=about',
			//'Ad' => $portal_path . '?action=ad',
			'Contact us' => $portal_path . '?action=contact',
			'' => $portal_path . '?action=predmca',
		));

		$currentPage = $_SERVER['PHP_SELF'];
		if ($currentPage == $portal_path)
			if (isset($_REQUEST["action"]))
				$currentPage .= '?action=' . $_REQUEST["action"];
			else
				$currentPage .= '?revealed';

		$header =
<<<EOD
<div class="header">
<h1>Project Throwback</h1>
<ul class="droplinemenu">

EOD;
		foreach ($topLevelLinks as $topLevelText=>$subLevelLinks) {
			$topLevelMenuItemClass = ($currentPage == $subLevelLinks[0]) ? "current" : NULL;

			$menuEntry =
<<<EOD
<a href="{$subLevelLinks[0]}">{$topLevelText}</a>
<ul>

EOD;
			if (!empty($subLevelLinks[2])) {
				foreach ($subLevelLinks[2] as $subLevelText=>$subLevelLink) {
					if ($currentPage == $subLevelLink) {
						$menuEntry .= '<li class="current"><a href="' . $subLevelLink . '">' . $subLevelText . "</a></li>\n";
						$topLevelMenuItemClass = "default";
					} else {
						$menuEntry .= '<li><a href="' . $subLevelLink . '">' . $subLevelText . "</a></li>\n";
					}
				}
			} else {
				$menuEntry .= "<li class=\"spacer\"></li>\n";
			}
			if ($topLevelMenuItemClass != NULL)
				$menuEntry = "<li id=\"$subLevelLinks[1]\" class=\"$topLevelMenuItemClass\">\n" . $menuEntry;
			else
				$menuEntry = "<li id=\"$subLevelLinks[1]\">\n" . $menuEntry;
			$menuEntry .=
<<<EOD
</ul>
</li>

EOD;

			$header .= $menuEntry;
		}
		$header .=
<<<EOD
</ul>
<div class="droplinemenuspacer">Choose a page from above.</div>
</div>

EOD;
		return $header;
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
<br />
<p>This site has been tested and works best on Microsoft Internet Explorer 8+, Mozilla Firefox, Google Chrome, and Opera.</p>
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
