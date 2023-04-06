<?php
function VerifPage($user, $verif) {
	require('../php/pdo.php');
	require('../php/website.php');

	$verif_page = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
	$verif_page->execute(array($user));
	$verif_page_infos = $verif_page->fetch();

	if($verif_page->rowCount() == 1) { // On vérifie ici si le joueur est enregistrer dans la table users_staffs !
	    if($verif_page_infos->$verif == 1) { // On vérifie ici si le joueur à accès à la page en question !
	        // Page autorisé !
	    } else {
	        header('Location: '.$website_infos->link.'/index');
	        exit();
	    }
	} else {
	    header('Location: '.$website_infos->link.'/index');
	    exit();
	}
}