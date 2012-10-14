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
class pjtbAdPage extends pjtbBasePage {
	protected function getBodyContent() {
		return
<<<EOD
<p>Are you dissatisfied with the direction that Nexon is taking MapleStory towards? Dismayed by all the new classes being thrown around after the Big Bang update? Drowning in all the new content that Nexon is just pushing out, like some kind of assembly line? Do you miss the days when MapleStory used to run smoothly on your computer? What happened to the good ol' days when we did not need to create a new character every update just to jump on some new bandwagon? Maybe you want to just play the game of those days, before Cygnus Knights, Arans, Evans, and all of those other forgettable classes that Nexon has just kept on introducing over and over. Or maybe you want to forgo the highly noticable latency increase that Nexon's service has been experiencing for the past few years now and the buggy features that Nexon has been rushing to release every update. Bloat is never a good thing, but Nexon does not seem to understand that.</p>
<p>Judging by the fact that even Nexon released nostalgia inducing content not too long ago - the <a href="https://www.facebook.com/notes/maplestory/v111-maple-class-reunion-update-notes/10151662801959298">Maple Class Reunion</a> - there must be a lot who miss the classic MapleStory and you're probably one of them.</p>
<p>Enter 2008. The MapleStory community is going crazy over the new addition of the Pirate class. Private servers were at the height of their popularity. Servers were going neck-to-neck in having the best implemented pirates features. Those were the times where several hundred or even a thousand players can be playing at once on a non-official server. But the real fun was on official MapleStory when the pirates class was finally officially released. It was the first class addition that Nexon added in the history of the game. There was an unprecedented amount of new interest in the game during a time when updates were rather stale.</p>
<p>Project Throwback takes you back to those days. We call ourselves a GMS-like server because our EXP, meso, and drop rates are rather reasonable in comparison to the rates that private servers of today and of the old days had. In fact, our rates will probably ease players back into the classic MapleStory days before the Big Bang increased leveling rates. Our feature set is faithful to what MapleStory had at the time, and we try our best not to add or detract from the authentic experience. Our main allure is not to give players the freedom to do more than what could be done on Nexon's service; instead, we appeal to those who like what Nexon had to offer back in 2008, but in a more personal and tight-knit community.</p>
<br />
<p>Recalling those days can be pretty difficult as a result of the limited amount of resources we have available about MapleStory's past. If you spot something that is not faithful to v0.62 MapleStory, or if you wish to help us in piecing together memories of the past, please contact us. We can use all the help that we can get, and getting the community more involved in our effort is one of our goals!</p>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>