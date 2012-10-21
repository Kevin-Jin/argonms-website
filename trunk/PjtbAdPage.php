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

require_once("PjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class PjtbAdPage extends PjtbBasePage {
	protected function getBodyContent() {
		return
<<<EOD
<p>Are you dissatisfied with the direction that Nexon is taking MapleStory towards? Dismayed by all the new classes being thrown around after the Big Bang update? Drowning in all the new content that Nexon is dumping on you?</p>
<p>What happened to the good ol' days when we did not need to create a new character every update just to jump on some new bandwagon? Maybe you want to just play the game of those days, before Cygnus Knights, Arans, Evans, and all of those other banal classes that Nexon has a bad habit of introducing were launched. Judging by the fact that even Nexon released nostalgia inducing content not too long ago - the <a href="http://maplestory.nexon.net/news/updates/update-notes/00Etn/v-111-maple-class-reunion-update-notes">Maple Class Reunion</a> - there must be a lot who miss the classic MapleStory and you probably are one of them.</p>
<p>Or maybe you want to forgo the highly noticable latency increase that Nexon's service has been experiencing for the past few years now and the bugs that plague the new content and features that Nexon rushes to release. Nexon does not seem to understand that bloat is never a good thing.</p>
<br />
<p>Enter 2008. Don't you remember the excitement on the day MapleStory Global officially released the pirates class? It was the first class addition that Nexon added in the history of the game. There was an unprecedented amount of new interest in the game during a time when updates were rather stale. But it was from that point forward that the volume of new content just became excessive.</p>
<p>Project Throwback takes you back to those days. We call ourselves a GMS-like server because our EXP, meso, and drop rates are rather reasonable in comparison to the rates that private servers of today and of the old days had. They are meant to ease players back into the classic MapleStory days — before the Big Bang increased leveling rates — yet still make leveling up feel rewarding. Our feature set is faithful to what MapleStory had at the time, and we try our best not to add or detract from the authentic experience. While most other private servers allure players by introducing features that do not exist on the official game, we appeal to those who want to play what Nexon offered back in 2008, but in a more personal and tight-knit community.</p>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>