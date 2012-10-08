<?php
if (!defined("allow entry"))
	require('hackingattempt.php');

function showTerms() {
	echo
<<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=us-ascii" />
<title>Project Throwback</title>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="common.css" />
<style type="text/css">
#content.outer {
	width: 800px;
	margin-left: auto;
	margin-right: auto;
}

#content.outer .inner {
	position: absolute;
	background: white;
	width: 800px;
}

#content.outer #terms.inner .body {
	background: #FADA8F;
}

form#login {
	padding: 10px;
}

.body h1 {
	margin-top: 0;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script type="text/javascript" src="common.js"></script>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
	$('#agree').click(function(event) {
		event.preventDefault();
		$('#terms').hide('blind', 500);
	});
});
// ]]>
</script>
</head>
<body>
<div id="content" class="outer">

<div id="revealed" class="inner">
<div class="body">
<form id="login" action="index.php?action=login&back={$_SERVER['PHP_SELF']}" method="post">
<p>You must log in in order to access your account control panel and other portions of this site.</p>
<p>Username:<input type="text" id="unamefield" name="username" maxlength="12" />Password:<input type="password" id="passwordfield" name="password" maxlength="12" /><input id="login" type="submit" value="Login" /></p>
<p>Or click <a href="index.php?action=regform">here</a> to register.</p>
</form>
<p><a href="forum" title="Enter the forums for help, news, and discussion">Click here to visit the forum.</a></p>
<p><a href="index.php?action=graph" title="View graphs that illustrate how much we have grown">Click here to view population statistics.</a></p>
</div>

EOD;
	require_once('common.php');
	showFooter();
	if (!isset($_REQUEST["revealed"])) {
		echo
<<<EOD

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

EOD;
		/*echo
<<<EOD
<p>If you are a representative of Nexon, please read <a href="index.php?action=letsbefriends">this statement</a>, prepared by the staff, before serving us a DMCA notice.</p>
<br />

EOD;*/
		echo
<<<EOD
<p>Please read the above statement carefully before proceeding.</p>
<div class="buttonset">
<a id="agree" class="positive" href="/pjtb/index.php?revealed">I agree</a>
<a id="disagree" class="negative" href="http://www.google.com">I disagree</a>
</div>
</div>

EOD;
	}

	echo
<<<EOD

</div>
</div>
</body>
</html>
EOD;
}

function showAbout() {
	echo
<<<EOD
<h1>ArgonMS</h1>
<h4><i>By GoldenKevin - founder, administrator, sole programmer of the service</i></h4>
<p>The core of Project Throwback is a pretty large program that I've been writing called ArgonMS. It is a new engine that I built from the ground up that is chiefly made up of a combination of the best sources around at the time, mixed with my own hard work.</p>
<h1>Purpose/Credits</h1>
<p>ArgonMS is the culmination of the years of hard work by the MapleStory private server and emulation community. Truly, this project would not have gotten anywhere without you. Despite being built from the ground up, this project has incorporated much from my predecessors. The heart of Project Throwback is essentially a rewrite of the also Java-based OdinMS, with a more robust and efficient model. I started the project knowing full well what was to be expected from it. I reviewed OdinMS code and illustrated improved logic and design. I think all projects should be rebuilt once the feature set is fully matured, as it is usually the case that during the initial design phases, developers cannot account for the future. The Vana project served as a huge source of inspiration for many of the new design choices I put into the project, and the codebase of ArgonMS is a mixing pot of mostly my own algorithms, as well as some of Vana's and some original OdinMS' code. OdinMS became my source of everything that I needed that needed to be reverse engineered, as I am more talented as a programmer than a hacker. For example, I have built the encryption algorithm off of OdinMS, while incorporating my own performance enhancements, and consulted much of its packet structure interpretations when writing my own logic. Code from Vana played a vital role in helping me fix some inaccurate interpretations so that the emulation could be as accurate as possible to Nexon's original model.</p>

<h1>Name</h1>
<p>In keeping with the tradition of naming MapleStory emulation projects after chemical elements (e.g. Titan(ium)MS, Vana(dium) Dev, Krypto(n)dev), I decided on the element Argon. Argon is a noble gas, stable with a full octet. In more ways than one, this is in line with the purpose of ArgonMS: to be a simple, lightweight, and stable MapleStory server emulator.</p>
<h1>Future</h1>
<p>I plan on releasing ArgonMS publicly as open source software when I am satisified with its progress or if I feel threatened that the project will shut down early. Once this happens, anyone is free to create their own clones of Project Throwback or modify the source as they wish to add features that would not normally be in a GMS-like source. The more help I get, the faster this process will play out. If you have knowledge of the MapleStory of 2008 or substantial experience in programming (preferably Java) and can prove your skills, please consider being part of the development team.</p>
EOD;
}

function showLetsBeFriends() {
	echo 
<<<EOD
<p>Unlike other private servers, we do not offer many incentives to our players. While there are many other servers that coerce its users with discounts on Cash Shop purchases, Project Throwback does not even offer the use of the in-game Cash Shop. Furthermore, as Nexon's makes nearly all of its profits off of Cash Shop purchases, Project Throwback does not make a dent in Nexon's profit in this regard. Our users play Project Throwback just because it is inherently more enjoyable than Nexon's service, and not because the service is more competitively priced.</p>
<p>This service was born as an educational project to see how well a Java program can scale to thousands of network clients on one machine and to familiarize ourselves with good code design and organization (composition, inheritance, and interfaces in object oriented languages and effective use of namespaces/packages), highly scalable concurrent programming (java.util.concurrent, java.util.concurrent.locks, and java.util.concurrent.atomic packages), SQL databases (MySQL), Java socket APIs (OIO, NIO, NIO.2 asynchronous IO) as well as the Netty framework in the past, Java file I/O, Subversion version control and Trac project management, server sided JavaScript (Mozilla Rhino), Java GUI APIs (Swing), Java XML APIs (StAX), encryption and message digests (Bouncy Castle lightweight API), the Telnet protocol, and much more. In short: one highly efficient application that could accept thousands of clients with minimal latency and reosurce usage. The goal of this service was to gain a large enough userbase and expensive hardware to stress the application and see whether the algorithms developed perform well and are bug-free.</p>
<p>Portions of the code that were not inherited from past MapleStory emulator projects were developed by us in a clean room environment - that is, through prior knowledge of gameplay, reverse engineering, and network packet analyzing; and not by cracking into any binary files that Nexon distributes to clients nor any leaked server files.</p>
<p>I would also like to point out that besides for the MapleStory trademark, this site does not use Nexon's intellectual property at all. You will find that our website uses no images acquired through the MapleStory game, nor do we distribute any binaries that may contain Nexon's property. We provide our internet address that users could connect to our service with, but we do not distribute Nexon's own package for MapleStory v0.62, nor do we distribute modified client binaries that connect to our service. Users have to both 1.) download Nexon's MapleStory v0.62 installation package from a third party and 2.) either edit an executable themselves or download an already edited binary from a third party in order to connect to our service. Considering that "Congress shall make no law [...] abridging the freedom of speech" (US Const., amend. I), we see no reason why this website should be targeted for a DMCA as this site is essentially a gathering place. No unlawful activities are performed on this site that overrides that fundamental law of the land that Nexon America operates in, and the only property owned by Nexon that exists on this site (besides user content not condoned by the staff that could be promptly removed by moderators) is the MapleStory trademark itself. In this way, this site is no different than MapleStory fan sites that are not the target of DMCA such as BasilMarket.com, Sleepywood.Net, Hidden Street, Southperry.net, or Maple Radio, that are actually officially sanctioned by Nexon (as evidenced by the links to those sites on the official MapleStory website).</p>
<p>Oh, and Lloyd Korn: to your "If you put lipstick on a pig, it's still a pig," we liken it more to reconstructing a dinosaur using only fossils and hints from its modern day relatives than dressing up a pig. That is what it's like to emulate the earlier versions of MapleStory so faithfully without being able to play it today. Why am I being targeted for litigation when we should be applauded for our efforts - for being so determined to restore a version of MapleStory that Nexon probably does not even have any backups of?</p>
<p>Now if that does not sway you, let us make our final appeal. The DMCA, in its current form, is unconstitutional. It discourages competition and results in monopolies.</p>
<p>You may ask, "How is that relevant to us?" The thing is, your product, MapleStory, is fundamentally free-to-play. Why would your customers choose us, a group that you consider untrustworthy and insecure, rather than a corporate giant like you who has a liability to protect their privacy and credentials, if no money is involved at all? Not only are we free-to-play, we have omitted all features that require the user to pay us in any form. That means no Cash Shop, no Nexon Cash, etc., and our community can attest to that (although like mentioned on the disclaimers page, we accept donations, but these donations do not grant the contributors any form of favoritism or in-game benefits). This gives you a major advantage. Yet, why do we still have a community that is substantial enough that you have to take us down because you believe we are "stealing" your customers?</p>
<p>Simple, we provide the better product. Why don't we both compete with each other and try to give the end users a better experience instead of going at each other's throats? Now we may be romantics, but we truly think we can cooperate. Surely our products are almost identical, but nothing we do is unfair in any way. The only code that we wrote and that compiles to a program that our community can interact with is a hundred percent original and written by the free software community and ourselves, and does not use any of your proprietary code. This is the ideal of capitalism.</p>
<p>I would also like to point out we're not even in direct competition with you. The players that join our service are those are prefer the classic versions of MapleStory - something that is no longer offered by Nexon today, and we have no plans at all to update the service to target recent versions of Nexon's product. The version of Nexon's product that this service targets was launched November 11th, 2008 - software that is <i>four years old</i> and almost unrecognizable to today's MapleStory. Ask any of the players on this server is they prefer the bloated game Nexon offers today. We don't even have any of the flashy features that other private servers have, such as "rebirths" or high experience, currency, and item drop rates. This only strengthens our argument that the players here are playing just because they like older versions of MapleStory, or because they prefer the community here. Just how some people miss the online servers of old games that have had their servers shut down (such as Xbox Live enabled games for the original Microsoft Xbox console), the players of this community feel nostalgic for, dare we say obsolete, versions of MapleStory.</p>
<p>In addition, we recommend that you read <a href="http://techlawadvisor.com/dmca/research.html">this report</a> written by an opponent of the DMCA and consider it a bit.</p>
<p>And also consider this. Are you familiar with the name Edward Felten? He was an educated man who wanted to publish a research paper, but was scared out of his wits of the DMCA so he forgoed it. Why should this happen? Why must educational projects, like our own, be intimidated by big, multinational, multimillion corporations?</p>
<p>The sad thing is, we know that you don't care at all about this because all you worry about is money and keeping your job, so you wouldn't even consider forwarding this statement to your clients. But still, we appreciate your taking the time to read this. Now before you send us the DMCA, could you acknowledge in your takedown request that you at least read through this appeal?</p>
EOD;
}
?>