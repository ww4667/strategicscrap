<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/inc/util.php');

if($_SERVER["HTTPS"] == "on") {
	$newurl = "http://www.strategicscrap.com" . $_SERVER["REQUEST_URI"];
	redirect_to($newurl);
	exit();
}
?>