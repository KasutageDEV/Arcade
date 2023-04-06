<?php
require('php/pdo.php');
require('php/session.php');
require('php/website.php');

if(isset($_SESSION['id'])) {
	$link = file_get_contents('https://api.habbocity.me/avatar_info.php?user='.$session_infos->username.'&key=Arcade_8757');
	$api_hc = json_decode($link);
	$motto = $api_hc->{'motto'};
}
?>