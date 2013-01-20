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

require_once("PjtbBasePage.php");

/**
 *
 * @author GoldenKevin
 */
class PjtbFinalStatement extends PjtbBasePage {
	protected function getBodyContent() {
		return
<<<EOD
<p>To Lloyd Korn, or whoever is now employed as the attorney of Nexon America:</p>
<p>Unlike other private servers, we do not offer many incentives to our players. We do not even take any donations in exchange for benefits in game. Our users play Project Throwback just because it is inherently more enjoyable than Nexon's service, and not because the service is more competitively priced.</p>
<p>This service was born as an educational project to see how well a Java program can scale to thousands of network clients on one machine and to familiarize ourselves with good code design and organization (composition, inheritance, and interfaces in object oriented languages and effective use of namespaces/packages), highly scalable concurrent programming (java.util.concurrent, java.util.concurrent.locks, and java.util.concurrent.atomic packages), SQL databases (MySQL), Java socket APIs (OIO, NIO, NIO.2 asynchronous IO) as well as the Netty framework in the past, Java file I/O, Subversion version control and Trac project management, server sided JavaScript (Mozilla Rhino), Java GUI APIs (Swing), Java XML APIs (StAX), encryption and message digests (Bouncy Castle lightweight API), the Telnet protocol, web development, and much more. In short: one highly efficient application that could accept thousands of clients with minimal latency and reosurce usage. The goal of this service was to gain a large enough userbase and expensive hardware to stress the application and see whether the algorithms developed perform well and are bug-free.</p>
<p>Portions of the code that were not inherited from past MapleStory emulator projects were developed by us in a clean room environment - i.e., through knowledge of gameplay from prior use, reverse engineering, and network packet analyzing; and not by cracking into any binary files that Nexon distributes to clients nor any leaked server files. The only code that we wrote and that compiles to a program that our community can interact with is a hundred percent original and written by the free software community and ourselves, and does not make use any of your proprietary code.</p>
<p>Besides for the MapleStory trademark, this site does not use Nexon's intellectual property at all. You will find that our website uses no images acquired through the MapleStory game, nor do we distribute any binaries that may contain Nexon's property. We provide our internet address that users could connect to our service with, but we do not distribute Nexon's own package for MapleStory v0.62, nor do we distribute modified client binaries that connect to our service. Users have to both 1.) download Nexon's MapleStory v0.62 installation package from a third party and 2.) either edit an executable themselves or download an already edited binary from a third party in order to connect to our service. This site does not distribute DRM-circumvented content of Nexon's nor does it distribute freely available content of Nexon's. The only property owned by Nexon that exists on this site (besides user content not condoned by the staff that could be promptly removed by moderators) is the MapleStory trademark itself. In this way, this site is no different than MapleStory fan sites that are not the target of DMCA takedown notices such as BasilMarket.com, Sleepywood.Net, Hidden Street, Southperry.net, or Maple Radio, that are in fact sanctioned by Nexon (as evidenced by the links to those sites on the official MapleStory website).</p>
<p>Oh, and Lloyd Korn, in response to your "if you put lipstick on a pig, it's still a pig" comment: we liken it more to reconstructing a dinosaur using only fossils and hints from its modern day relatives than dressing up a pig. That is what it's like to emulate the earlier versions of MapleStory so faithfully without being able to play it today. Why are we being targeted for litigation when our efforts should be commendable - for being so determined to restore a version of MapleStory that Nexon has left in the dust?</p>
<br />
<p>And now we want to direct this address to your client - Nexon.</p>
<p>Why would your customers choose us, a group that they deem untrustworthy and insecure (cf. "another danger private servers pose concerns the security of information"), rather than a corporate giant like you who has a liability to protect their privacy and credentials, if no money is involved at all? Not only are we free-to-play, we have omitted all features that require the user to pay us in any form. That means no Cash Shop, no Nexon Cash, etc., and our community can attest to that (although like mentioned on the disclaimers page, we accept donations, but these donations do not grant the contributors any form of favoritism or in-game benefits). This gives you a major advantage in terms of amount of content. Yet, why do we still have a community that is substantial enough that you have to take us down because you believe we are "stealing" your customers?</p>
<p>We're not collecting profits. Some of us are just students who wanted to program something ambitious, and, after three years of hard work, decided to deploy it. Our intent in allowing others to play was to test our code on a large scale, fix bugs, find where we could improve performance, and learn valuable experience along the way. You may claim that we have stolen a significant chunk of your playerbase, but we took steps to make sure that would not be the case. One of which was our decision over which version of MapleStory to target - we wanted to attract those who preferred a classic version of MapleStory: one that can no longer be played today on Nexon's service; was launched November 11th, 2008 (i.e. is <em>four years old</em>); is almost unrecognizable to today's MapleStory; and whose gameplay is significantly different than that of today's MapleStory (i.e. it is "Before Big Bang"). Note that we have absolutely no plans to update the service to target recent versions of Nexon's product. We did not and do not want to directly compete with your service and "steal" users that still would play the current iteration of MapleStory. If you ask every one of the players of our service whether they would play the official MapleStory today, we're sure most of them would say that they would not.</p>
<p>We're not criticizing Nexon by the way. We actually believe you're doing a great job with meeting the demands of the majority of the users, but some just don't like the way you're going and want an alternative - i.e. a more conservative MapleStory. Such people would not have stayed with your service anyway, so we see no harm in attracting them towards our service.</p>
<p>We don't even have any of the flashy features that other private servers have to entice users, such as "rebirths" or high experience, currency, and item drop rates. This only strengthens our argument that the players here are playing just because they like older versions of MapleStory, or because they prefer the community here. Just how some people miss the online servers of old games that have had their servers shut down (such as Xbox Live enabled games for the original Microsoft Xbox console), the players of this community feel nostalgic for "obsolete" versions of MapleStory.</p>
<br />
<p>If Nexon has a complaint regarding content on this service and website, and that complaint has not been resolved by this page, they may direct their concerns to <a href="mailto:project.throwback.ms@gmail.com">project.throwback.ms@gmail.com</a>. We will do our best to resolve any issues regarding the content that is posted on this website, and will comply with a request for immediate discontinuation of both the service itself and distribution of the source code of the service if 1.) we receive a claim that we have attempted to rebut but are unable to disprove within five days after receiving it, and 2.) there is no other solution that could be settled outside of court. Should such be the case, we only request that the agreement between Nexon and Project Throwback allows this website to still exist as a gathering ground after the takedown of any infringing content that Nexon and we agree to remove.</p>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>
