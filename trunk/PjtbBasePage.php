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
abstract class PjtbBasePage {
	protected abstract function getTitle();

	protected abstract function getBodyContent();

	protected function getHtmlHeader() {
		$title = $this->getTitle();
		return
<<<EOD
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>{$title}</title>
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="common.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
EOD;
	}

	protected function getPageHeader() {
		require_once('Config.php');

		$topLevelLinks = array();
		$topLevelLinks['Main'] = array(Config::getInstance()->portalPath . '?revealed', 'a', array(
			'Rankings' => Config::getInstance()->portalPath . '?action=ranking',
			'Activity' => Config::getInstance()->portalPath . '?action=activity',
			'Server status' => Config::getInstance()->portalPath . '?action=status',
			'Rates' => Config::getInstance()->portalPath . '?action=rates'
		));
		if (isset($_SESSION['loggedInAccountId'])) {
			$subLevelLinks = array(
				'Vote' => Config::getInstance()->portalPath . '?action=vote',
				'User control panel' => Config::getInstance()->portalPath . '?action=cp',
				'Log out' => Config::getInstance()->portalPath . '?action=logout'
			);
			if (/*isGm*/false)
				$subLevelLinks['Moderator Control Panel'] = Config::getInstance()->portalPath . '?action=gmcp';
			if (/*isAdmin*/false)
				$subLevelLinks['Administrator Control Panel'] = Config::getInstance()->portalPath . '?action=acp';

			$topLevelLinks['User'] = array(Config::getInstance()->portalPath . '?action=cp', 'b', $subLevelLinks);
		} else {
			$topLevelLinks['User'] = array(Config::getInstance()->portalPath . '?action=loginform', 'b', array(
				'Log in' => Config::getInstance()->portalPath . '?action=loginform',
				'Register' => Config::getInstance()->portalPath . '?action=regform'
			));
		}
		$topLevelLinks['Forum'] = array('/forum', 'c', array());
		$topLevelLinks['About'] = array(Config::getInstance()->portalPath . '?action=about', 'd', array(
			'About' => Config::getInstance()->portalPath . '?action=about',
			'Mission' => Config::getInstance()->portalPath . '?action=ad',
			'Staff' => Config::getInstance()->portalPath . '?action=staff',
			'Contact us' => Config::getInstance()->portalPath . '?action=contact',
		));
		$hiddenLinksDefaults = array(
			Config::getInstance()->portalPath . '?action=predmca' => 'About',
			Config::getInstance()->portalPath . '?action=loginsubmit' => 'User',
			Config::getInstance()->portalPath . '?action=regsubmit' => 'User',
			Config::getInstance()->portalPath . '?action=logout' => 'User'
		);

		$currentPage = $_SERVER['PHP_SELF'];
		if ($currentPage == Config::getInstance()->portalPath)
			if (isset($_REQUEST["action"]))
				$currentPage .= '?action=' . $_REQUEST["action"];
			else
				$currentPage .= '?revealed';

		$currentPageDefault = null;
		if (array_key_exists($currentPage, $hiddenLinksDefaults))
			$currentPageDefault = $hiddenLinksDefaults[$currentPage];

		$header =
<<<EOD
<div class="header">
<h1>Project Throwback</h1>
<h2>A small town feel free for everyone</h2>
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
			if ($currentPageDefault == $topLevelText)
				$topLevelMenuItemClass = "default";
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
<p>&copy; 2012-2013 Project Throwback. All Rights Reserved.</p>
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
