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
	require_once('HackingAttempt.php');

require_once("PjtbLoginFormPage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class PjtbTermsPage extends PjtbLoginFormPage {
	protected function getBodyContent() {
		$content = '';
		if (isset($_SESSION['loggedInAccountId'])) {
			require_once('Config.php');
			$portalPath = Config::$portalPath;
			$content = "Click <a href=\"$portalPath?action=cp\">here to open your control panel.</a>";
		} else {
			$content = parent::getBodyContent();
		}
		$content .= "\n<p>You may navigate the site through the bar above.</p>";
		return $content;
	}

	protected function getHtmlHeader() {
		return parent::getHtmlHeader() .
<<<EOD

<style type="text/css">
#content.outer {
	width: 800px;
	margin-left: auto;
	margin-right: auto;
}

#content.outer .inner {
	z-index: 3;
	position: absolute;
	background: white;
	width: 800px;
}

#content.outer #terms.inner .body {
	background: #FADA8F;
}

form#loginform {
	padding: 10px;
}

.body h1 {
	margin-top: 0;
}
</style>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
	$('#agree').click(function(event) {
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		$('#terms').hide('blind', 500);
	});
});
// ]]>
</script>
EOD;
	}

	protected function getHtmlBody() {
		require_once('Config.php');
		$portalPath = Config::$portalPath;

		$body = 
<<<EOD
<div id="content" class="outer">

<div id="revealed" class="inner">

EOD;
		$body .= parent::getHtmlBody() . "\n"; //the login form
		if (!isset($_REQUEST["revealed"])) {
			$body .=
<<<EOD
</div>

<div id="terms" class="inner">
<div class="body">
<h1>Project Throwback Disclaimer</h1>
<p>The service, i.e. this website and the related MapleStory server emulator, is strictly for educational purposes only. MapleStory is a trademark of Nexon, i.e. NEXON Korea Corp., NEXON America Inc., and all other subsidiaries of NEXON Korea Corp. The service is independent of Nexon, which is neither affiliated with nor involved in the production of the service, and does not sponsor or endorse the service. We respect Nexon's trademark as well as their business and proprietary interests.</p>
<p>We, the maintainers, administrators, and owner of the service, do not intend to make a profit nor induce losses for Nexon. Some funds may be collected by means of ex gratia donations for service upkeep expenses ONLY. Users who have donated any amount to the service will not receive any benefits or be given preferential treatment, nor will their donations be transmuted into any form of in-game currency. It is not our intent to take potential customers from Nexon or compete with Nexon using its own intellectual property.</p>
<p>We do not condone the usage of Nexon's intellectual property on the service. The service does not host or use any intellectual property of Nexon, and emulation was developed through legal reverse engineering means only, with none of Nexon's own proprietary code. The website only provides a message board, an account control panel, and the network address of the server that hosts the emulator.</p>
<p>We do not condone any modifications done to Nexon's intellectual property. The service only provides a server that allows users to connect to as an alternative to Nexon's services, solely on the user's own accord. None of us coerced or supported any user of the service into modifying Nexon's property. Any user who demonstrates support for modifying Nexon's property or advertises any methods to modify Nexon's property will be given a warning and have any offending posts removed, while repeat offenders will be forbidden from accessing the service. Any comments that may be found here at Project Throwback are the express opinions and or the property of their individual authors. Therefore, we can not be held responsible for any damage they may cause to Nexon. The views expressed by the users of the service do not necessarily reflect our views.</p>
<p>We reserve the right to forbid any user from accessing the service if they can be considered a threat to the functioning of the service.</p>
<p>Should any user or outside party identify any content that is harmful or malicious to Nexon, or to the other users of the service, we request that he or she contact us via <a href="index.php?action=contact">this page</a> so we may rectify the problem.</p>
<br />

<p>Please read the above statement carefully before proceeding.</p>
<div class="buttonset">
<a id="agree" class="positive" href="{$portalPath}?revealed">I agree</a>
<a id="disagree" class="negative" href="http://www.google.com">I disagree</a>
</div>
</div>
</div>

EOD;
		}
		$body .= "\n</div>";
		return $body;
	}
}
?>
