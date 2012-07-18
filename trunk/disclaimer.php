<?php
if (!defined("allow entry"))
	require('hackingattempt.php');

function loginPrompt() {
	return "<form action=\"index.php?action=login&back=".$_SERVER['PHP_SELF']."\" method=\"post\">\r\n"
		. "<div>\r\n"
		. "<p>Username:<input type=\"text\" id=\"unamefield\" name=\"username\" maxlength=\"12\" />Password:<input type=\"password\" id=\"passwordfield\" name=\"password\" maxlength=\"12\" /><input id=\"login\" type=\"submit\" value=\"Login\" /></p>\r\n"
		. "<p>Or click <a href=\"index.php?action=regform\">here</a> to register.</p>\r\n"
		. "</div>\r\n"
		. "</form>";
}

function showTerms() {
	if (!isset($_REQUEST["nonjs"])) {
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"\r\n"
			. "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n"
			. "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\">\r\n"
			. "<head>\r\n"
			. "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=us-ascii\" />\r\n"
			. "<title>Project Throwback</title>\r\n"
			. "<link rel=\"stylesheet\" type=\"text/css\" href=\"common.css\" />\r\n"
			. "<script type=\"text/javascript\" src=\"common.js\"></script>\r\n"
			. "<script type=\"text/javascript\">\r\n"
			. "// <![CDATA[\r\n"
			. "function showLoginPrompt() {\r\n"
			. "	var div = document.getElementById(\"agreement\");\r\n"
			. "	div.setAttribute(\"id\", \"login\");\r\n"
			. "	div.setAttribute(\"class\", null);\r\n"
			. "	div.innerHTML = \"".str_replace(array("\n", "\r"), "", str_replace("\"", "\\\"", loginPrompt()))."\";\r\n"
			. "}\r\n"
			. "\r\n"
			. "setStartupFunction(function() {\r\n"
			. "	document.getElementById(\"agree\").setAttribute(\"href\", \"javascript: showLoginPrompt();\");\r\n"
			. "});\r\n"
			. "// ]]>\r\n"
			. "</script>\r\n"
			. "</head>\r\n"
			. "<body>\r\n"
			. "<div>\r\n"
			. "<h1>Project Throwback Mission Statement</h1>\r\n"
			. "<p>The service, i.e. this website and the related MapleStory server emulator, is strictly for educational purposes only. MapleStory is a trademark of Nexon, i.e. NEXON Korea Corp., NEXON America Inc., and all other subsidiaries of NEXON Korea Corp. The service is independent of Nexon, which is neither affiliated with nor involved in the production of the service, and does not sponsor or endorse the service. We respect Nexon's trademark as well as their business and proprietary interests.</p>\r\n"
			. "<p>We, the maintainers, administrators, and owner of the service, do not intend to make a profit nor induce losses for Nexon. Some funds may be collected by means of ex gratia donations for service upkeep expenses ONLY. Users who have donated any amount to the service will not receive any benefits or be given preferential treatment, nor will their donations be transmuted into any form of in-game currency. It is not our intent to take potential customers from Nexon or compete with Nexon using its own intellectual property.</p>\r\n"
			. "<p>We do not condone the usage of Nexon's intellectual property on the service. The service does not host or use any intellectual property of Nexon, and emulation was developed through legal reverse engineering means only, with none of Nexon's own proprietary code. The website only provides a message board, an account control panel, and the network address of the server that hosts the emulator.</p>\r\n"
			. "<p>We do not condone any modifications done to Nexon's intellectual property. The service only provides a server that allows users to connect to as an alternative to Nexon's services, solely on the user's own accord. None of us coerced or supported any user of the service into modifying Nexon's property. Any user who demonstrates support for modifying Nexon's property or advertises any methods to modify Nexon's property will be given a warning and have any offending posts removed, while repeat offenders will be forbidden from accessing the service. Any comments that may be found here at ThrowbackMS are the express opinions and or the property of their individual authors. Therefore, we can not be held responsible for any damage they may cause to Nexon. The views expressed by the users of the service do not necessarily reflect our views.</p>\r\n"
			. "<p>We reserve the right to forbid any user from accessing the service if they can be considered a threat to the functioning of the service.</p>\r\n"
			. "<p>We have forfeited all rights to storing Nexon's intellectual property on our personal and developing computers, and have forfeited all rights to registering an account with Nexon. As such, Nexon's current Terms of Use, as well as Nexon's Terms of Use during the time that the service was started have no binding on us.</p>\r\n"
			. "<p>Should any user identify any such content that is harmful or malicious to Nexon or the other users of the service, we request that he or she contact us via <a href=\"contact.php\">this page</a> so we may rectify the problem.</p>\r\n"
			. "<br />\r\n"
			. "<p>If you are a representative of Nexon, please read <a href=\"index.php?action=letsbefriends\">this statement</a>, prepared by the staff, before serving us a DMCA notice.</p>\r\n"
			. "<br />\r\n"
			. "<p>Please read the above disclaimer carefully before proceeding.</p>\r\n"
			. "<div id=\"agreement\" class=\"buttonset\">\r\n"
			. "<a id=\"agree\" class=\"positive\" href=\"".$_SERVER['PHP_SELF']."?nonjs\">I'm ok with it!</a>\r\n"
			. "<a id=\"disagree\" class=\"negative\" href=\"http://www.google.com\">I object!</a>\r\n"
			. "</div>\r\n"
			. "</div>\r\n"
			. "</body>\r\n"
			. "</html>";
	} else {
		echo loginPrompt();
	}
}

function showAbout() {
	echo "<h1>ArgonMS</h1>\r\n"
		. "<p>The core of Project Throwback is a pretty large program that I've been writing called ArgonMS. It is a new engine that I built from the ground up that is chiefly made up of a combination of the best sources around at the time, mixed with my own hard work.</p>\r\n"
		. "<h1>Purpose/Credits</h1>\r\n"
		. "<p>ArgonMS is the culmination of the years of hard work by the MapleStory private server and emulation community. Truly, this project would not have gotten anywhere without you. Despite being built from the ground up, this project has incorporated much from my predecessors. The heart of Project Throwback is essentially a rewrite of the also Java-based OdinMS, with a more robust and efficient model. I started the project knowing full well what was to be expected from it. I reviewed OdinMS code and illustrated improved logic and design. I think all projects should be rebuilt once the feature set is fully matured, as it is usually the case that during the initial design phases, developers cannot account for the future. The Vana project served as a huge source of inspiration for many of the new design choices I put into the project, and the codebase of ArgonMS is a mixing pot of mostly my own algorithms, as well as some of Vana's and some original OdinMS' code. OdinMS became my source of everything that I needed that needed to be reverse engineered, as I am more talented as a programmer than a hacker. For example, I have built the encryption algorithm off of OdinMS, while incorporating my own performance enhancements, and consulted much of its packet structure interpretations when writing my own logic. Code from Vana played a vital role in helping me fix some inaccurate interpretations so that the emulation could be as accurate as possible to Nexon's original model.</p>\r\n"
		. "\r\n"
		. "<h1>Name</h1>\r\n"
		. "<p>In keeping with the tradition of naming MapleStory emulation projects after chemical elements (e.g. Titan(ium)MS, Vana(dium) Dev, Krypto(n)dev), I decided on the element Argon. Argon is a noble gas, stable with a full octet. In more ways than one, this is in line with the purpose of ArgonMS: to be a simple, lightweight, and stable MapleStory server emulator.</p>\r\n"
		. "<h1>Future</h1>\r\n"
		. "<p>I plan on releasing ArgonMS publicly as open source software when I am satisified with its progress or if I feel threatened that the project will shut down early. Once this happens, anyone is free to create their own clones of Project Throwback or modify the source as they wish to add features that would not normally be in a GMS-like source. The more help I get, the faster this process will play out. If you have knowledge of the MapleStory of 2008 or substantial experience in programming (preferably Java) and can prove your skills, please consider being part of the development team.</p>\r\n";
}

function showLetsBeFriends() {
	echo "<p>Unlike other private servers, we do not offer many incentives to our players. While there are many other servers that coerce its users with discounts on Cash Shop purchases, Project Throwback does not even offer the use of the in-game Cash Shop. Furthermore, as Nexon's makes nearly all of its profits off of Cash Shop purchases, Project Throwback does not make a dent in Nexon's profit in this regard. Our users play Project Throwback just because it is inherently more enjoyable than Nexon's service, and not because the service is more competitively priced.</p>\r\n"
		. "<p>I would also like to point out that besides for the MapleStory trademark, this site does not use Nexon's intellectual property at all. You will find that our website uses no images acquired through the MapleStory game, nor do we distribute any binaries that may contain Nexon's property. We provide our internet address that users could connect to our service with, but we do not distribute Nexon's own package for MapleStory v0.62, nor do we distribute modified client binaries that connect to our service. Users have to both 1.) download Nexon's MapleStory v0.62 installation package from a third party and 2.) either edit an executable themselves or download an already edited binary from a third party in order to connect to our service.</p>\r\n"		
		. "<p>Now if that does not sway you, let me make my final appeal. The DMCA is unconstitutional. It discourages competition and results in monopolies.</p>\r\n"
		. "<p>You may ask, \"How is that relevant to us?\" The thing is, your product, MapleStory, is fundamentally free-to-play. Why would your customers choose us, a group that you consider untrustworthy and insecure, rather than a corporate giant like you who has a liability to protect their privacy and credentials, if no money is involved at all? Not only are we free-to-play, we have omitted all features that require the user to pay us in any form. That means no Cash Shop, no Nexon Cash, etc., and our community can attest to that (although like mentioned on the disclaimers page, we accept donations, but these donations do not grant the contributors any form of favoritism or in-game benefits). This gives you a major plus. Yet, why do we still have a community that is substantial enough that you have to take us down because you believe we are \"stealing\" your customers?</p>\r\n"
		. "<p>Simple, we provide the better product. Why don't we both compete with each other and try to give the end users a better experience instead of going at each other's throats? Now I may be a romantic, but I truly think we can cooperate. Surely our products are almost identical, but nothing we do is unfair in any way. The only code that we wrote and that compiles to a program that our community can interact with is a hundred percent original and written by the free software community and ourselves, and does not use any of your proprietary code. This is the ideal of capitalism.</p>\r\n"
		. "<p>In addition, I recommend that you read <a href=\"http://techlawadvisor.com/dmca/research.html\">this report</a> written by an opponent of the DMCA and consider it a bit.</p>\r\n"
		. "<p>And also consider this. Are you familiar with the name Edward Felten? He was an educated man who wanted to publish a research paper, but was scared out of his wits of the DMCA so he forgoed it. Why should this happen? Why must educational projects, like my own, be intimidated by big, multinational, multimillion corporations?</p>\r\n"
		. "<p>Thank you for taking your time to read this. Now before you send us the DMCA, could you acknowledge in your takedown request that you at least read through this spiel?</p>";
}
?>