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
class pjtbRegistrationFormPage extends pjtbBasePage {
	protected function getBodyContent() {
		require('config.php');
		return
<<<EOD

<div id="stylized" class="regform">
<form action="{$portal_path}?action=regsubmit" method="post">
<h1>Project Throwback Registration</h1>
<p>Please be sure to read and act on any red prompt before hitting Register.</p>
<div class="row">
<div class="label">Username<span class="small">Your account's login ID</span></div>
<input type="text" id="unamefield" name="username" maxlength="12" />
</div>

<div class="row">
<div class="label">Password</div>
<input type="password" id="pwdfield" name="password" maxlength="12" />
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
<input type="text" id="birthyearfield" name="birthyear" maxlength="4" />
</div>
</div>
<div><input id="register" type="submit" value="Register" /></div>
<div class="spacer"></div>
</form>
</div>

EOD;
	}

	protected function getTitle() {
		return "Project Throwback Registration";
	}

	protected function getHtmlHeader() {
		require('config.php');
		return parent::getHtmlHeader() .
<<<EOD

<style type="text/css">
.regform {
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.regform p, .regform h1, .regform form {
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
<script type="text/javascript">
// <![CDATA[
var horizontal_offset = -8; //horizontal offset of hint box from text field, in pixels

var vertical_offset = -8; //vertical offset of hint box from text field, in pixels
var ie = document.all;
var ns6 = document.getElementById && !document.all;
var nextZ = 0;

function getPosOffset(what, offsettype) {
	return (offsettype == "left") ? what.offset().left : what.offset().top;
}

function ieCompatTest() {
	return (document.compatMode && document.compatMode!="BackCompat") ? document.documentElement : document.body;
}

function clearBrowserEdge(dropmenuobj, obj, side, x, y) {
	var edgeoffset = (side == "right") ? -horizontal_offset : -vertical_offset;
	if (side == "right") {
		var windowedge = ie && !window.opera ? ieCompatTest().scrollLeft + ieCompatTest().clientWidth + 10 : window.pageXOffset + window.innerWidth;
		if (windowedge - x < dropmenuobj.outerWidth() + horizontal_offset)
			edgeoffset = dropmenuobj.outerWidth() + obj.outerWidth() + horizontal_offset;
	} else {
		var windowedge = ie && !window.opera ? ieCompatTest().scrollTop + ieCompatTest().clientHeight - 15 : window.pageYOffset + window.innerHeight - 18;
		if (windowedge - y < dropmenuobj.outerHeight())
			edgeoffset = dropmenuobj.outerHeight() - obj.outerHeight();
	}
	return edgeoffset;
}

function showHint(menucontents, obj, tipwidth, error) {
	if (ie || ns6) {
		var dropmenuobj = getHintBox(obj);
		dropmenuobj.html(menucontents);
		if (tipwidth != "")
			dropmenuobj.css('width', tipwidth);
		var x = getPosOffset(obj, "left") + obj.outerWidth();
		var y = getPosOffset(obj, "top");
		dropmenuobj.css('left', x - clearBrowserEdge(dropmenuobj, obj, "right", x, y) + "px");
		dropmenuobj.css('top', y - clearBrowserEdge(dropmenuobj, obj, "bottom", x, y) + "px");
		dropmenuobj.css('visibility', "visible");
		dropmenuobj.css('z-index', nextZ++);
		if (error)
			dropmenuobj.css('background', "#CC3300");
		else
			dropmenuobj.css('background', "#FFCC66");
	}
}

function hideHint(obj) {
	$("#hintbox_" + obj.attr("id")).css("visibility", "hidden").css("left", "-500px");
}

function hintVisible(obj) {
	return $("#hintbox_" + obj.attr("id")).css("visibility") == "visible";
}

function createHintBox(id) {
	return $('<div id="hintbox_' + id + '" class="hintbox"></div>').appendTo('body');
}

function getHintBox(obj) {
	var dropmenuobj = $("#hintbox_" + obj.attr("id"));
	if (dropmenuobj.length !== 0)
		return dropmenuobj;
	return createHintBox(obj.attr("id"));
}

var usernameOk = false;
var passwordOk = false;

function hintTextMatch(obj, menucontents) {
	if (!hintVisible(obj))
		return false;
	return (getHintBox(obj).html() == menucontents);
}

function checkUsername(obj) {
	$.get("{$portal_path}?action=namecheck&name=" + obj.val(), function(resp) {
		if (resp != "") { //we'll return an empty string for no conflicts
			showHint("The username " + resp + " is already being used.", obj, "250px", true);
			usernameOk = false;
			updateSubmitButton();
		}
	});
}

function showUsernameHint(e) {
	if (!hintVisible($(this)) && $(this).val().length == 0) {
		var message = "Must be between 4-12 characters long. Permitted characters: uppercase and lowercase letters, numbers, and underscore";
		showHint(message, $(this), "250px", false);

		$(this).on('blur', function(e2) {
			if (hintTextMatch($(this), message))
				hideHint($(this));
			$(this).off('blur');
		});
	} else {
		getHintBox($(this)).css('z-index', nextZ++);
	}
}

function changingUsername(e) {
	var code = e.which;
	if (code != 0)
		hideHint($(this));
	//digit keys; uppercase letter keys; lowercase letter keys; underscore; enter; F5, arrow keys, etc.; backspace; tab key
	if (!(code >= 48 && code <= 57 || code >= 65 && code <= 90 || code >= 97 && code <= 122 || code == 95 || code == 13 || code == 0 || code == 8 || code == 9)) {
		showHint("Permitted characters: uppercase and lowercase letters, numbers, and underscore", $(this), "250px", false);
		e.returnValue = false;
		(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	}
}

function usernameChanged(e) {
	var code = e.which;
	if (code == 8 || code == 46)
		hideHint($(this)); //backspace and delete will not fire keypress in webkit, so we have to remove hintbox here
	if (!hintVisible($(this))) {
		var length = $(this).val().length;
		if (length < 4) {
			usernameOk = false;
			showHint("Must be at least 4 characters long", $(this), "250px", true);
		} else if (length > 12) {
			usernameOk = false;
			showHint("Must be less than 13 characters long", $(this), "250px", true);
		} else {
			checkUsername($(this));
			usernameOk = true;
		}
		updateSubmitButton();
	}
}

function showPasswordHint(e) {
	if (!hintVisible($(this)) && $(this).val().length == 0) {
		var message = "Must be between 5-12 characters long. Permitted characters: uppercase letters, lowercase letters, and numbers";
		showHint(message, $(this), "250px", false);
		$(this).on('blur', function(e2) {
			if (hintTextMatch($(this), message))
				hideHint($(this));
			$(this).off('blur');
		});
	} else {
		getHintBox($(this)).css('z-index', nextZ++);
	}
}

function changingPassword(e) {
	var code = e.which;
	if (code != 0)
		hideHint($(this));
	//digit keys; uppercase letter keys; lowercase letter keys; enter; F5, arrow keys, etc.; backspace; tab key
	//client supports sending practically any printable ASCII character in a password, but we'll make it easier on ourselves here
	if (!(code >= 48 && code <= 57 || code >= 65 && code <= 90 || code >= 97 && code <= 122 || code == 13 || code == 0 || code == 8 || code == 9)) {
		showHint("Permitted characters: uppercase letters, lowercase letters, and numbers", $(this), "250px", false);
		(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	}
}

function passwordChanged(e) {
	var code = e.which;
	if (code == 8 || code == 46)
		hideHint($(this)); //backspace and delete will not fire keypress in webkit, so we have to remove hintbox here
	if (!hintVisible($(this))) {
		var length = $(this).val().length;
		if (length < 5) {
			passwordOk = false;
			showHint("Must be at least 5 characters long", $(this), "250px", true);
		} else if (length > 12) {
			passwordOk = false;
			showHint("Must be less than 13 characters long", $(this), "250px", true);
		} else {
			passwordOk = true;
		}
		updateSubmitButton();
	}
}

function updateSubmitButton() {
	if (!usernameOk || !passwordOk)
		$("#register").attr('disabled', 'disabled');
	else
		$("#register").removeAttr('disabled');
}

function updateValidBirthdays(obj) {
	var days = $("#birthdayselect")[0];
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

$(document).ready(function() {
	$(window).on('resize', function(event) {
		$('.hintbox').each(function(i, element) {
			var dropmenuobj = $(element);
			if (dropmenuobj.css('visibility') == "visible") {
				var obj = $('#' + dropmenuobj.attr("id").substring("hintbox_".length));
				var x = getPosOffset(obj, "left") + obj.outerWidth();
				var y = getPosOffset(obj, "top");
				dropmenuobj.css('left', x - clearBrowserEdge(dropmenuobj, obj, "right", x, y) + "px");
				dropmenuobj.css('top', y - clearBrowserEdge(dropmenuobj, obj, "bottom", x, y) + "px");
			}
		});
	});
	//instead of just cutting off the user when > 12 characters, give them an error/hint if js is enabled
	$("#unamefield").removeAttr("maxlength");
	$("#pwdfield").removeAttr("maxlength");

	//in case the user's browser saved some of the form data for some reason,
	//make sure our state is synced up.
	var obj = $("#unamefield");
	var length = obj.val().length;
	if (length >= 4 && length <= 12) {
		checkUsername(obj);
		usernameOk = true;
	}
	length = $("#pwdfield").val().length;
	if (length >= 5 && length <= 12)
		passwordOk = true;
	updateSubmitButton();

	//TODO: disable paste in Opera
	$('#unamefield, #pwdfield').on('cut paste', function(e) {
		//cut may delete character count to below requirement
		//paste may insert character count to above limit or introduce illegal characters
		//so just don't let either happen
		(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	});
	$('#unamefield').on('click', showUsernameHint).on('keypress', changingUsername).on('keyup', usernameChanged);
	$('#pwdfield').on('click', showPasswordHint).on('keypress', changingPassword).on('keyup', passwordChanged);
	$('#birthyearfield').on('keypress', function(e) {
		var code = e.which;
		//digit keys; enter; F5, arrow keys, etc.; backspace; tab key
		if (!(code >= 48 && code <= 57 || code == 13 || code == 0 || code == 8 || code == 9))
			(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	}).on('paste', function(e) {
		//paste may introduce illegal characters, so just don't let it happen
		(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	});
});
// ]]>
</script>
EOD;
	}
}
?>