<?php
if (!defined("allow entry"))
	require('hackingattempt.php');

function nameCheck() {
	require_once('databasemanager.php');
	$con = makeDatabaseConnection();
	$ps = $con->prepare("SELECT COUNT(*) FROM `accounts` WHERE `name` = ?");
	$ps->bind_param('s', $_GET["name"]);
	$ps->execute();
	$ps->bind_result($usermatchcount);
	if ($ps->fetch() && $usermatchcount > 0)
		echo $_GET["name"];
	$ps->close();
	$con->close();
}

function registerForm() {
	echo
<<<EOD
<?xml version="1.0" encoding="us-ascii"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Project Throwback Registration</title>
<meta http-equiv="Content-Type" content="text/html;charset=us-ascii" />
<link rel="stylesheet" type="text/css" href="common.css" />
<style type="text/css">
body {
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
p, h1, form {
	border: 0;
	margin: 0;
	padding: 0;
}
.spacer {
	clear: both;
	height: 1px;
}
/* ----------- Reg Form ----------- */
.regform {
	margin: 0 auto;
	width: 400px;
	padding: 14px;
}

/* ----------- stylized ----------- */
#stylized {
	border: solid 2px #b7ddf2;
	background: #ebf4fb;
	filter: alpha(opacity=80);
	opacity: 0.8;
}
#stylized h1 {
	font-size: 14px;
	font-weight: bold;
	margin-bottom: 8px;
}
#stylized p {
	font-size: 11px;
	color: #666666;
	margin-bottom: 20px;
	border-bottom: solid 1px #b7ddf2;
	padding-bottom: 10px;
}
#stylized .small {
	color: #666666;
	display: block;
	font-size: 11px;
	font-weight: normal;
	text-align: right;
	width: 140px;
}
#stylized .row {
	padding: 2px 0 20px 0;
}
#stylized .row .label {
	display: block;
	font-weight: bold;
	text-align: right;
	width: 140px;
	float: left;
}
#stylized input {
	font-size: 12px;
	padding: 4px 2px;
	border: solid 1px #aacfe4;
	width: 194px;
	margin: 2px 0 0 10px;
}
#stylized .birthdate {
	float: left;
	width: 200px;
	margin: 2px 0 0 10px;
}
#stylized .birthdate input {
	float: right;
	width: 50px;
	margin: 0 0 20px 0;
	padding: 4px 0;
}
#stylized input#register {
	clear: both;
	margin: 0 0 0 150px;
	padding: 0;
	width: 125px;
	height: 31px;
	background: #666666;
	text-align: center;
	line-height: 31px;
	color: #FFFFFF;
	font-size: 11px;
	font-weight: bold;
	border: none;
}

/* -------- popup hint box -------- */
.hintbox {
	position: absolute;
	top: 0;
	background-color: #ebf4fb;
	filter: alpha(opacity=80);
	opacity: 0.8;
	width: 150px; /*Default width of hint.*/
	padding: 3px;
	border:1px solid black;
	font:normal 11px Verdana;
	line-height:18px;
	z-index:100;
	border-right: 3px solid black;
	border-bottom: 3px solid black;
	visibility: hidden;
}
</style>
<script type="text/javascript" src="common.js"></script>
<script type="text/javascript">
// <![CDATA[
var horizontal_offset = -8; //horizontal offset of hint box from text field, in pixels

var vertical_offset = -8; //horizontal offset of hint box from text field, in pixels
var ie = document.all;
var ns6 = document.getElementById && !document.all;
var nextZ = 0;

function getPosOffset(what, offsettype) {
	var totaloffset = (offsettype == "left") ? what.offsetLeft : what.offsetTop;
	var parentEl = what.offsetParent;
	while (parentEl != null){
		totaloffset = (offsettype == "left") ? totaloffset + parentEl.offsetLeft : totaloffset + parentEl.offsetTop;
		parentEl = parentEl.offsetParent;
	}
	return totaloffset;
}

function ieCompatTest() {
	return (document.compatMode && document.compatMode!="BackCompat") ? document.documentElement : document.body;
}

function clearBrowserEdge(dropmenuobj, obj, side) {
	var edgeoffset = (side == "right") ? horizontal_offset * -1 : vertical_offset * -1;
	if (side == "right") {
		var windowedge = ie && !window.opera ? ieCompatTest().scrollLeft + ieCompatTest().clientWidth + 10 : window.pageXOffset + window.innerWidth;
		if (windowedge - dropmenuobj.x < dropmenuobj.offsetWidth + horizontal_offset)
			edgeoffset = dropmenuobj.offsetWidth + obj.offsetWidth + horizontal_offset;
	} else {
		var windowedge = ie && !window.opera ? ieCompatTest().scrollTop + ieCompatTest().clientHeight - 15 : window.pageYOffset + window.innerHeight - 18;
		dropmenuobj.contentmeasure = dropmenuobj.offsetHeight;
		if (windowedge - dropmenuobj.y < dropmenuobj.contentmeasure)
			edgeoffset = dropmenuobj.contentmeasure - obj.offsetHeight;
	}
	return edgeoffset;
}

function showHint(menucontents, obj, tipwidth, error) {
	if (ie || ns6) {
		var dropmenuobj = getHintBox(obj);
		dropmenuobj.innerHTML = menucontents;
		if (tipwidth != "") {
			dropmenuobj.widthobj = dropmenuobj.style;
			dropmenuobj.widthobj.width = tipwidth;
		}
		dropmenuobj.x = getPosOffset(obj, "left") + obj.offsetWidth;
		dropmenuobj.y = getPosOffset(obj, "top");
		dropmenuobj.style.left = dropmenuobj.x - clearBrowserEdge(dropmenuobj, obj, "right") + "px";
		dropmenuobj.style.top = dropmenuobj.y - clearBrowserEdge(dropmenuobj, obj, "bottom") + "px";
		dropmenuobj.style.visibility = "visible";
		dropmenuobj.style.zIndex = nextZ++;
		if (error)
			dropmenuobj.style.backgroundColor = "#CC3300";
		else
			dropmenuobj.style.backgroundColor = "#FFCC66";
	}
}

function hideHint(obj) {
	var dropmenuobj = document.getElementById("hintbox_" + obj.getAttribute("id"));
	if (dropmenuobj != null) {
		dropmenuobj.style.visibility = "hidden";
		dropmenuobj.style.left = "-500px";
	}
}

function hintVisible(obj) {
	var dropmenuobj = document.getElementById("hintbox_" + obj.getAttribute("id"));
	if (dropmenuobj != null)
		return (dropmenuobj.style.visibility == "visible");
	return false;
}

function createHintBox(id) {
	var divblock = document.createElement("div");
	divblock.setAttribute("id", "hintbox_" + id);
	divblock.setAttribute("class", "hintbox");
	document.body.appendChild(divblock);
	return divblock;
}

function getHintBox(obj) {
	var dropmenuobj = document.getElementById("hintbox_" + obj.getAttribute("id"));
	if (document.getElementById("hintbox_" + obj.getAttribute("id")))
		return dropmenuobj;
	dropmenuobj = createHintBox(obj.getAttribute("id"));
	return dropmenuobj;
}

var usernameOk = false;
var passwordOk = false;

function hintTextMatch(obj, menucontents) {
	if (!hintVisible(obj))
		return false;
	return (getHintBox(obj).innerHTML == menucontents);
}

function checkUsername(obj) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp = new XMLHttpRequest();
	} else {
		//code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var resp = xmlhttp.responseText;
			if (resp != "") { //we'll return an empty string for no conflicts
				showHint("The username " + resp + " is already being used.", obj, "250px", true);
				usernameOk = false;
				updateSubmitButton();
			}
		}
	}
	xmlhttp.open("GET", "index.php?action=namecheck&name=" + obj.value, true);
	xmlhttp.send();
}

function showUsernameHint(obj) {
	if (!hintVisible(obj) && obj.value.length == 0) {
		var message = "Must be between 4-12 characters long. Permitted characters: uppercase and lowercase letters, numbers, and underscore";
		showHint(message, obj, "250px", false);
		obj.onblur = function(obj2, event) {
			if (hintTextMatch(obj, message))
				hideHint(obj);
			obj.onblur = null;
		};
	} else {
		getHintBox(obj).style.zIndex = nextZ++;
	}
}

function changingUsername(obj, event) {
	var code = event.charCode;
	if (code != 0)
		hideHint(obj);
	if (!(code >= 48 && code <= 57 || code >= 65 && code <= 90 || code >= 97 && code <= 122 || code == 95 || code == 13 || code == 0)) {
		showHint("Permitted characters: uppercase and lowercase letters, numbers, and underscore", obj, "250px", false);
		event.returnValue = false;
		event.preventDefault();
	}
}

function usernameChanged(obj, event) {
	var code = event.keyCode;
	if (code == 8 || code == 46)
		hideHint(obj); //backspace and delete will not fire onkeypress/changingUsername in webkit, so we have to remove hintbox here
	if (!hintVisible(obj)) {
		var length = obj.value.length;
		if (length < 4) {
			usernameOk = false;
			showHint("Must be at least 4 characters long", obj, "250px", true);
		} else if (length > 12) {
			usernameOk = false;
			showHint("Must be less than 13 characters long", obj, "250px", true);
		} else {
			checkUsername(obj);
			usernameOk = true;
		}
		updateSubmitButton();
	}
}

function showPasswordHint(obj) {
	if (!hintVisible(obj) && obj.value.length == 0) {
		var message = "Must be between 5-12 characters long. Permitted characters: uppercase and lowercase letters, numbers, and underscore";
		showHint(message, obj, "250px", false);
		obj.onblur = function(obj2, event) {
			if (hintTextMatch(obj, message))
				hideHint(obj);
			obj.onblur = null;
		};
	} else {
		getHintBox(obj).style.zIndex = nextZ++;
	}
}

function changingPassword(obj, event) {
	var code = event.charCode;
	if (code != 0)
		hideHint(obj);
	if (!(code >= 48 && code <= 57 || code >= 65 && code <= 90 || code >= 97 && code <= 122 || code == 95 || code == 13 || code == 0)) {
		showHint("Permitted characters: uppercase and lowercase letters, numbers, and underscore", obj, "250px", false);
		event.returnValue = false;
		event.preventDefault();
	}
}

function passwordChanged(obj, event) {
	var code = event.keyCode;
	if (code == 8 || code == 46)
		hideHint(obj); //backspace and delete will not fire onkeypress/changingPassword in webkit, so we have to remove hintbox here
	if (!hintVisible(obj)) {
		var length = obj.value.length;
		if (length < 5) {
			passwordOk = false;
			showHint("Must be at least 5 characters long", obj, "250px", true);
		} else if (length > 12) {
			passwordOk = false;
			showHint("Must be less than 13 characters long", obj, "250px", true);
		} else {
			passwordOk = true;
		}
		updateSubmitButton();
	}
}

function updateSubmitButton() {
	document.getElementById("register").disabled = (!usernameOk || !passwordOk);
}

function updateValidBirthdays(obj) {
	var days = document.getElementById("birthdayselect");
	//february will always be a leap year...
	switch (obj.selectedIndex) {
		case 0: //january
		case 2: //march
		case 4: //may
		case 6: //july
		case 7: //august
		case 9: //october
		case 11: //december
			switch (days.length) {
				case 29: //last was february
					var option = document.createElement("option");
					option.text = "30";
					option.setAttribute("value", "30");
					days.add(option, null);
					option = document.createElement("option");
					option.text = "31";
					option.setAttribute("value", "31");
					days.add(option, null);
					break;
				case 30: //last was either april, june, september, november
					var option = document.createElement("option");
					option.text = "31";
					option.setAttribute("value", "31");
					days.add(option, null);
					break;
				case 31: //last was either january, february, march, may, july, august, october, december
					break;
			}
			break;
		case 3: //april
		case 5: //june
		case 8: //september
		case 10: //november
			switch (days.length) {
				case 29: //last was february
					var option = document.createElement("option");
					option.text = "30";
					option.setAttribute("value", "30");
					days.add(option, null);
					break;
				case 30: //last was either april, june, september, november
					break;
				case 31: //last was either january, february, march, may, july, august, october, december
					days.remove(30);
					break;
			}
			break;
		case 1: //february
			switch (days.length) {
				case 29: //last was february
					break;
				case 30: //last was either april, june, september, november
					days.remove(29);
					break;
				case 31: //last was either january, february, march, may, july, august, october, december
					days.remove(30);
					days.remove(29);
					break;
			}
			break;
	}
}

function windowLoaded() {
	window.onresize = function(event) {
		var elements;
		if (document.getElementsByClassName) {
			elements = document.getElementsByClassName("hintbox");
		} else {
			var hasClassName = new RegExp("(?:^|\s)" + className + "(?:$|\s)");
			var allElements = document.getElementsByTagName("*");
			elements = [];

			var element;
			for (var i = 0; (element = allElements[i]) != null; i++) {
				var elementClass = element.className;
				if (elementClass && elementClass.indexOf(className) != -1 && hasClassName.test(elementClass))
					elements.push(element);
			}
		}
		var element;
		for (var i = 0; i < elements.length; i++) {
			element = elements[i];
			if (element.style.visibility == "visible") {
				var elementName = element.getAttribute("id");
				var obj = document.getElementById(elementName.substring(8, elementName.length));
				element.x = getPosOffset(obj, "left") + obj.offsetWidth;
				element.y = getPosOffset(obj, "top");
				element.style.left = element.x - clearBrowserEdge(element, obj, "right") + "px";
				element.style.top = element.y - clearBrowserEdge(element, obj, "bottom") + "px";
			}
		}
	};
	//instead of just cutting off the user when > 12 characters, give them an error/hint if js is enabled
	document.getElementById("unamefield").setAttribute("maxlength", null);
	document.getElementById("pwdfield").setAttribute("maxlength", null);

	//in case the user's browser saved some of the form data for some reason,
	//make sure our state is synced up.
	var obj = document.getElementById("unamefield");
	var length = obj.value.length;
	if (length >= 4 && length <= 12) {
		checkUsername(obj);
		usernameOk = true;
	}
	obj = document.getElementById("pwdfield");
	length = obj.value.length;
	if (length >= 5 && length <= 12)
		passwordOk = true;
	updateSubmitButton();
}

setStartupFunction(windowLoaded);
// ]]>
</script>
</head>
<body>

<div id="stylized" class="regform">
<form action="index.php?action=regsubmit" method="post">
<h1>Project Throwback Registration</h1>
<p>Please be sure to read and act on any red prompt before hitting Register.</p>
<div class="row">
<div class="label">Username<span class="small">Your account's login ID</span></div>
<input type="text" id="unamefield" name="username" maxlength="12" onclick="showUsernameHint(this);" onkeypress="changingUsername(this, event);" onkeyup="usernameChanged(this, event);" onpaste="event.returnValue = false;" oncut="event.returnValue = false;" />
</div>

<div class="row">
<div class="label">Password</div>
<input type="password" id="pwdfield" name="password" maxlength="12" onclick="showPasswordHint(this);" onkeypress="changingPassword(this, event);" onkeyup="passwordChanged(this, event);" onpaste="event.returnValue = false;" oncut="event.returnValue = false;" />
</div>

<div class="row">
<div class="label">Birthday
<span class="small">Only needed for character deletion</span>
</div>
<div class="birthdate">
<select id="birthmonthselect" name="birthmonth" onchange="updateValidBirthdays(this);">
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<select id="birthdayselect" name="birthday">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<input type="text" id="birthyearfield" name="birthyear" maxlength="4" onkeyup="this.value = this.value.replace(/[^\d]/, '')" />
</div>
</div>
<div><input id="register" type="submit" value="Register" /></div>
<div class="spacer"></div>
</form>
</div>

</body>
</html>
EOD;
}

function doRegister() {
	if (!isset($_POST["username"]) || !isset($_POST["password"]))
		require('hackingattempt.php');

	//client side JS should've checked these, but just in case there was a glitch, or js is disabled...
	if (!is_numeric($_POST["birthyear"])) {
		echo 'Birthyear must be a number!';
	} else if (strlen($_POST["password"]) < 5) {
		echo 'Password is too short. Your password must be at between 5-12 characters long. Please try another.<br \><input type="button" value="Back" onclick="history.back(-1)" />';
	} else if (strlen($_POST["password"]) > 12) {
		echo 'Password is too long. Your password must be at between 5-12 characters long. Please try another.<br \><input type="button" value="Back" onclick="history.back(-1)" />';
	} else if (strlen($_POST["username"]) < 4) {
		echo 'Username is too short. Your username must be between 4-12 characters long. Please try another.<br \><input type="button" value="Back" onclick="history.back(-1)" />';
	} else if (strlen($_POST["username"]) > 12) {
		echo 'Username is too long. Your username must be between 4-12 characters long. Please try another.<br \><input type="button" value="Back" onclick="history.back(-1)" />';
	} else if (!preg_match('/^[A-Za-z0-9_]+$/', $_POST["username"])) {
		//Surprisingly enough, the client does not give "You have entered an incorrect LOGIN ID" for any
		//names with at least one non-alphanumeric character (and underscore), except for period and at sign.
		//But, let's just limit them to alphanumeric and underscore anyway.
		echo 'Username must only consist of the characters a-z (lowercase letters), A-Z (uppercase letters), 0-9 (numbers), and _ (underscore). Please try another.<br \><input type="button" value="Back" onclick="history.back(-1)" />';
	} else {
		require_once('databasemanager.php');
		$con = makeDatabaseConnection();

		$alreadyexists = false;
		$ps = $con->prepare("SELECT COUNT(*) FROM `accounts` WHERE `name` = ?");
		$ps->bind_param('s', $_POST["username"]);
		$ps->execute();
		$ps->bind_result($usermatchcount);
		if ($ps->fetch() && $usermatchcount > 0)
			$alreadyexists = true;
		$ps->close();

		if ($alreadyexists) {
			echo 'That username is already being used. Please try another.<br \><input type="button" value="Back" onclick="history.back(-1)" />';
		} else {
			require_once('hashfunctions.php');
			$salt = makeSalt();
			$passhash = makeSaltedSha512Hash($_POST["password"], $salt);

			$birthday = $_POST["birthyear"] * 10000 + intval($_POST["birthmonth"]) * 100 + intval($_POST["birthday"]);

			$ps = $con->prepare("INSERT INTO `accounts`(`name`,`password`,`salt`,`birthday`) VALUES (?,?,?,?)");
			$ps->bind_param('sssi', $_POST["username"], $passhash, $salt, $birthday);
			$ps->execute();
			$ps->close();
			echo 'User '.$_POST["username"].' registered successfully.';
		}
		$con->close();
	}
}