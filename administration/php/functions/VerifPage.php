<?php
function VerifPage($user, $verif) {
	require('../php/pdo.php');
	require('../php/website.php');

	$verif_page = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
	$verif_page->execute(array($user));
	$verif_page_infos = $verif_page->fetch();

	if($verif_page->rowCount() == 0) {
		 header('Location: '.$website_infos->link.'/index');
		 exit();
	}

	if($verif_page_infos->$verif == 0) {
		header('Location: '.$website_infos->link.'/index');
		exit();
	}
}