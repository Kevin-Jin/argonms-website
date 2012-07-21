<?php
if (!defined("allow entry"))
	require('hackingattempt.php');

function sendToPage($timeout, $message, $url) {
	echo
<<<EOD
<html>
<head>
<meta http-equiv="Refresh" content="$timeout; $url">
</head>
<body>
<p>$message momentarily (or click <a href="$url">here</a> to do so immediately).</p>
</body>
</html>
EOD;
}

function loginAuthenticate() {
	if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_REQUEST["back"]))
		require('hackingattempt.php');

	require_once('databasemanager.php');
	require_once('hashfunctions.php');
	$con = makeDatabaseConnection();
	$ps = $con->prepare("SELECT `id`,`password`,`salt` FROM `accounts` WHERE `name` = ?");
	$ps->bind_param('s', $_POST["username"]);
	if ($ps->execute()) {
		$rs = $ps->get_result();
		if ($array = $rs->fetch_array()) {
			$correct = false;
			$hasSalt = isset($array[2]);
			switch (strlen($array[1])) {
				case 20: //sha-1 (160 bits = 20 bytes)
					$correct = $hasSalt && checkSaltedSha1Hash($array[1], $_POST["password"], $array[2]) || !$hasSalt && checkSha1Hash($array[1], $pwd);
					//only update to SHA512 w/ salt if we are sure the given password matches the SHA1 hash
					$hashUpdate = $correct;
					break;
				case 64: //sha-512 (512 bits = 64 bytes)
					$correct = $hasSalt && checkSaltedSha512Hash($array[1], $_POST["password"], $array[2]) || !$hasSalt && checkSha512Hash($array[1], $_POST["password"]);
					//only update to SHA512 w/ salt if we are sure the given password matches and we don't already have a salt
					$hashUpdate = $correct && !$hasSalt;
					break;
				case 5:
				case 6:
				case 7:
				case 8:
				case 9:
				case 10:
				case 11:
				case 12: //plaintext - client only sends password (5 <= chars <= 12)
					$correct = $array[1] == $_POST["password"];
					//only update to SHA512 w/ salt if we are sure the given password matches the plaintext
					$hashUpdate = $correct;
					break;
				default:
					$correct = false;
					//don't update to SHA512 w/ salt if we can't verify the given password
					$hashUpdate = false;
					break;
			}
			if ($correct) {
				if ($hashUpdate) {
					$ps->close();
					$salt = makeSalt();
					$passhash = makeSaltedSha512Hash($_POST["password"], $salt);
					$ps = $con->prepare("UPDATE `accounts` SET `password` = ?, `salt` = ? WHERE `id` = ?");
					$ps->bind_param('ssi', $passhash, $salt, $array[0]);
					$ps->execute();
				}
				sendToPage(3, "You have successfully logged in. You will be brought to your account's control panel", "index.php?action=cp");
			} else {
				sendToPage(3, "That password is incorrect. You will be brought back to the last page", $_REQUEST["back"]);
			}
		} else {
			sendToPage(3, "That username is incorrect. You will be brought back to the last page", $_REQUEST["back"]);
		}
	}
	$ps->close();
	$con->close();
}
?>