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

function hashWithDigest($in, $algo) {
	return hash($algo, $in, true);
}

function hexSha1($in) {
	return hashWithDigest($in, "sha1");
}

function hexSha512($in) {
	return hashWithDigest($in, "sha512");
}

function checkSha1Hash($actualHash, $check) {
	return strcmp($actualHash, hexSha1($check)) == 0;
}

function checkSha512Hash($actualHash, $check) {
	return strcmp($actualHash, hexSha512($check)) == 0;
}

function concat($password, $salt) {
	return $password.$salt;
}

function checkSaltedSha1Hash($actualHash, $check, $salt) {
	return strcmp($actualHash, hexSha1(concat($check, $salt))) == 0;
}

function checkSaltedSha512Hash($actualHash, $check, $salt) {
	return strcmp($actualHash, hexSha512(concat($check, $salt))) == 0;
}

function makeSalt() {
	$salt = '';
	for ($i = 0; $i < 16; $i++)
		$salt .= chr(rand(0, 255));
	return $salt;
}

function makeSaltedSha512Hash($password, $salt) {
	return hexSha512(concat($password, $salt));
}
?>