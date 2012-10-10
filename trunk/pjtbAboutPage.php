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
class pjtbAboutPage extends pjtbBasePage {
	protected function getBodyContent() {
		return
<<<EOD
<h1>ArgonMS</h1>
<h4><i>This article written by GoldenKevin - founder, administrator, sole programmer of the service</i></h4>
<p>The core of Project Throwback is a pretty large program that I've been writing called ArgonMS. It is a new engine that I built from the ground up that is chiefly made up of a combination of the best sources around at the time, mixed with my own hard work.</p>
<h1>Purpose/Credits</h1>
<p>ArgonMS is the culmination of the years of hard work by the MapleStory private server and emulation community. Truly, this project would not have gotten anywhere without you. Despite being built from the ground up, this project has incorporated much from my predecessors. The heart of Project Throwback is essentially a rewrite of the also Java-based OdinMS, with a more robust and efficient model. I started the project knowing full well what was to be expected from it. I reviewed OdinMS code and illustrated improved logic and design. I think all projects should be rebuilt once the feature set is fully matured, as it is usually the case that during the initial design phases, developers cannot account for the future. The Vana project served as a huge source of inspiration for many of the new design choices I put into the project, and the codebase of ArgonMS is a mixing pot of mostly my own algorithms, as well as some of Vana's and some original OdinMS' code. OdinMS became my source of everything that I needed that needed to be reverse engineered, as I am more talented as a programmer than a hacker. For example, I have built the encryption algorithm off of OdinMS, while incorporating my own performance enhancements, and consulted much of its packet structure interpretations when writing my own logic. Code from Vana played a vital role in helping me fix some inaccurate interpretations so that the emulation could be as accurate as possible to Nexon's original model.</p>

<h1>Name</h1>
<p>In keeping with the tradition of naming MapleStory emulation projects after chemical elements (e.g. Titan(ium)MS, Vana(dium) Dev, Krypto(n)dev), I decided on the element Argon. Argon is a noble gas, stable with a full octet. In more ways than one, this is in line with the purpose of ArgonMS: to be a simple, lightweight, and stable MapleStory server emulator.</p>
<h1>Future</h1>
<p>I plan on releasing ArgonMS publicly as open source software when I am satisified with its progress or if I feel threatened that the project will shut down early. Once this happens, anyone is free to create their own clones of Project Throwback or modify the source as they wish to add features that would not normally be in a GMS-like source. The more help I get, the faster this process will play out. If you have knowledge of the MapleStory of 2008 or substantial experience in programming (preferably Java) and can prove your skills, please consider being part of the development team.</p>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>
