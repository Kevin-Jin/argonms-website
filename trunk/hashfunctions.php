<?php
if (!defined("allow entry"))
	require('hackingattempt.php');

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