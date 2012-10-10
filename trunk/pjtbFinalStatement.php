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

require("pjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class pjtbFinalStatement extends pjtbBasePage {
	protected function getBodyContent() {
		return
<<<EOD
<p>Unlike other private servers, we do not offer many incentives to our players. While there are many other servers that coerce its users with discounts on Cash Shop purchases, Project Throwback does not even offer the use of the in-game Cash Shop. Furthermore, as Nexon's makes nearly all of its profits off of Cash Shop purchases, Project Throwback does not make a dent in Nexon's profit in this regard. Our users play Project Throwback just because it is inherently more enjoyable than Nexon's service, and not because the service is more competitively priced.</p>
<p>This service was born as an educational project to see how well a Java program can scale to thousands of network clients on one machine and to familiarize ourselves with good code design and organization (composition, inheritance, and interfaces in object oriented languages and effective use of namespaces/packages), highly scalable concurrent programming (java.util.concurrent, java.util.concurrent.locks, and java.util.concurrent.atomic packages), SQL databases (MySQL), Java socket APIs (OIO, NIO, NIO.2 asynchronous IO) as well as the Netty framework in the past, Java file I/O, Subversion version control and Trac project management, server sided JavaScript (Mozilla Rhino), Java GUI APIs (Swing), Java XML APIs (StAX), encryption and message digests (Bouncy Castle lightweight API), the Telnet protocol, and much more. In short: one highly efficient application that could accept thousands of clients with minimal latency and reosurce usage. The goal of this service was to gain a large enough userbase and expensive hardware to stress the application and see whether the algorithms developed perform well and are bug-free.</p>
<p>Portions of the code that were not inherited from past MapleStory emulator projects were developed by us in a clean room environment - that is, through prior knowledge of gameplay, reverse engineering, and network packet analyzing; and not by cracking into any binary files that Nexon distributes to clients nor any leaked server files.</p>
<p>I would also like to point out that besides for the MapleStory trademark, this site does not use Nexon's intellectual property at all. You will find that our website uses no images acquired through the MapleStory game, nor do we distribute any binaries that may contain Nexon's property. We provide our internet address that users could connect to our service with, but we do not distribute Nexon's own package for MapleStory v0.62, nor do we distribute modified client binaries that connect to our service. Users have to both 1.) download Nexon's MapleStory v0.62 installation package from a third party and 2.) either edit an executable themselves or download an already edited binary from a third party in order to connect to our service. Considering that "Congress shall make no law [...] abridging the freedom of speech" (US Const., amend. I), we see no reason why this website should be targeted for a DMCA as this site is essentially a gathering place. No unlawful activities are performed on this site that overrides that fundamental law of the land that Nexon America operates in, and the only property owned by Nexon that exists on this site (besides user content not condoned by the staff that could be promptly removed by moderators) is the MapleStory trademark itself. In this way, this site is no different than MapleStory fan sites that are not the target of DMCA such as BasilMarket.com, Sleepywood.Net, Hidden Street, Southperry.net, or Maple Radio, that are actually officially sanctioned by Nexon (as evidenced by the links to those sites on the official MapleStory website).</p>
<p>Oh, and Lloyd Korn, in response to your "if you put lipstick on a pig, it's still a pig" comment: we liken it more to reconstructing a dinosaur using only fossils and hints from its modern day relatives than dressing up a pig. That is what it's like to emulate the earlier versions of MapleStory so faithfully without being able to play it today. Why am I being targeted for litigation when we should be applauded for our efforts - for being so determined to restore a version of MapleStory that Nexon probably does not even have any backups of?</p>
<p>Now if that does not sway you, let us make our final appeal. The DMCA, in its current form, is unconstitutional. It discourages competition and results in monopolies.</p>
<p>You may ask, "How is that relevant to us?" The thing is, your product, MapleStory, is fundamentally free-to-play. Why would your customers choose us, a group that you consider untrustworthy and insecure, rather than a corporate giant like you who has a liability to protect their privacy and credentials, if no money is involved at all? Not only are we free-to-play, we have omitted all features that require the user to pay us in any form. That means no Cash Shop, no Nexon Cash, etc., and our community can attest to that (although like mentioned on the disclaimers page, we accept donations, but these donations do not grant the contributors any form of favoritism or in-game benefits). This gives you a major advantage. Yet, why do we still have a community that is substantial enough that you have to take us down because you believe we are "stealing" your customers?</p>
<p>Simple, we provide the better product. Why don't we both compete with each other and try to give the end users a better experience instead of going at each other's throats? Now we may be romantics, but we truly think we can cooperate. Surely our products are almost identical, but nothing we do is unfair in any way. The only code that we wrote and that compiles to a program that our community can interact with is a hundred percent original and written by the free software community and ourselves, and does not use any of your proprietary code. This is the ideal of capitalism.</p>
<p>I would also like to point out we're not even in direct competition with you. The players that join our service are those are prefer the classic versions of MapleStory - something that is no longer offered by Nexon today, and we have no plans at all to update the service to target recent versions of Nexon's product. The version of Nexon's product that this service targets was launched November 11th, 2008 - software that is <i>four years old</i> and almost unrecognizable to today's MapleStory. Ask any of the players on this server is they prefer the bloated game Nexon offers today. We don't even have any of the flashy features that other private servers have, such as "rebirths" or high experience, currency, and item drop rates. This only strengthens our argument that the players here are playing just because they like older versions of MapleStory, or because they prefer the community here. Just how some people miss the online servers of old games that have had their servers shut down (such as Xbox Live enabled games for the original Microsoft Xbox console), the players of this community feel nostalgic for, dare we say obsolete, versions of MapleStory.</p>
<p>In addition, we recommend that you read <a href="http://techlawadvisor.com/dmca/research.html">this report</a> written by an opponent of the DMCA and consider it a bit.</p>
<p>And also consider this. Are you familiar with the name Edward Felten? He was an educated man who wanted to publish a research paper, but was scared out of his wits of the DMCA so he forgoed it. Why should this happen? Why must educational projects, like our own, be intimidated by big, multinational, multimillion corporations?</p>
<p>The sad thing is, we know that you don't care at all about this because all you worry about is money and keeping your job, so you wouldn't even consider forwarding this statement to your clients. But still, we appreciate your taking the time to read this. Now before you send us the DMCA, could you acknowledge in your takedown request that you at least read through this appeal?</p>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>
