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

/**
 * 
 *
 * @author GoldenKevin
 */
class StringData {
	private static $JOBS = array(
		0 => "Beginner",
		100 => "Swordman",
		110 => "Fighter",
		111 => "Crusader",
		112 => "Hero",
		120 => "Page",
		121 => "White Knight",
		122 => "Paladin",
		130 => "Spearman",
		131 => "Dragon Knight",
		132 => "Dark Knight",
		200 => "Magician",
		210 => "Wizard (Fire,Poison)",
		211 => "Mage(Fire, Poison)",
		212 => "Arch Mage(Fire,Poison)",
		220 => "Wizard(Ice,Lightning)",
		221 => "Mage(Ice, Lightning)",
		222 => "Arch Mage(Ice,Lightning)",
		230 => "Cleric",
		231 => "Priest",
		232 => "Bishop",
		300 => "Archer",
		310 => "Hunter",
		311 => "Ranger",
		312 => "Bowmaster",
		320 => "Crossbow man",
		321 => "Sniper",
		322 => "Marksman",
		400 => "Rogue",
		410 => "Assassin",
		411 => "Hermit",
		412 => "Night Lord",
		420 => "Bandit",
		421 => "Chief Bandit",
		422 => "Shadower",
		500 => "Pirate",
		510 => "Brawler",
		511 => "Marauder",
		512 => "Buccaneer",
		520 => "Gunslinger",
		521 => "Outlaw",
		522 => "Corsair",
		900 => "GM",
		910 => "SuperGM"
	);

	public static function getJobName($jobId) {
		return self::$JOBS[$jobId];
	}
}
?>
