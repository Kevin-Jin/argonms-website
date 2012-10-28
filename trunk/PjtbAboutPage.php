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

if (!defined("allowEntry"))
	require_once('HackingAttempt.php');

require_once("PjtbBasePage.php");

/**
 * 
 *
 * @author GoldenKevin
 */
class PjtbAboutPage extends PjtbBasePage {
	protected function getHtmlHeader() {
		return parent::getHtmlHeader() .
<<<EOD

<style type="text/css">
p.signature {
	text-align: right;
	font-style: italic;
}
</style>
EOD;
	}

	protected function getBodyContent() {
		return
<<<EOD
<h1>ArgonMS</h1>
<p>The core of the Project Throwback service is a huge application that I've been writing for the past two years called ArgonMS. It is a new engine that I built from the ground up that consists of code from the highest quality open source MapleStory emulators cemented by my own implementations and glue code.</p>

<h2>Purpose/Credits</h1>
<p>ArgonMS is the culmination of the years of hard work by the MapleStory private server and emulation community. Despite being built from the ground up, this project has incorporated much from its predecessors. The heart of Project Throwback is essentially a rewrite of the also Java-based OdinMS, with a more robust and efficient model.</p>
<p>I started the project knowing full well what was to be expected from it. I painstakingly reviewed all OdinMS code and improved logic and design. The Vana project served as a huge source of inspiration for many of the new design choices I put into the project, and the codebase of ArgonMS is a mixing pot of mostly my own algorithms, as well as some of Vana's and some original OdinMS' code.</p>
<p>OdinMS became my source of everything that I needed that needed to be reverse engineered, as I am more talented as a programmer than a hacker. I have built the encryption algorithm off of OdinMS, while incorporating my own performance enhancements. I had also consulted the packet structure interpretations from previous authors when writing my own logic. Code from Vana played a vital role in helping me fix some inaccurate interpretations so that the emulation could be as accurate as possible to Nexon's original model.</p>
<p>I believe that all projects should be rewritten once their feature set is sufficiently mature, as developers cannot foresee the future and the changes it brings during the initial design phase. Teams should be able to learn from mistakes made in the past and make sure their solutions to bugs and new features and are more elegant and robust. OdinMS was no exception.</p>

<h2>Name</h1>
<p>In keeping with the tradition of naming MapleStory emulation projects after chemical elements (e.g. Titan(ium)MS, Vana(dium) Dev, Krypto(n)dev), I decided on the element Argon. Argon is a stable, noble gas. This reflects the goal of ArgonMS: to be a simple, lightweight, and stable MapleStory server emulator.</p>
<h2>Future</h1>
<p>I plan on releasing ArgonMS publicly as open source software when I am satisified with its progress or if I feel threatened that the project will shut down early. Once this happens, anyone is free to fork the source as they wish to add features that would not normally be in a GMS-like source. The more help I get, the faster this process will play out.</p>
<p>If you have extensive knowledge and experience of "before Big Bang" MapleStory, please consider assisting the development team. Recalling the behavior of v0.62 MapleStory be pretty difficult as a result of the limited amount of resources we have of MapleStory's past versions. If you spot something that is not faithful to v0.62 MapleStory, or if you wish to help us in piecing together memories of the past, please contact us. We can use all the help that we can get, and getting the community more involved in our effort is one of our goals!</p>
<p class="signature">-GoldenKevin</p>
EOD;
	}

	protected function getTitle() {
		return "Project Throwback";
	}
}
?>
