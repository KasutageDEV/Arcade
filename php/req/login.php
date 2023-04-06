<?php
require('../../global.php');
if(isset($_SESSION['id'])) {
	die('Une erreur est survenue.');
}

if(!empty($_POST['l_username']) AND !empty($_POST['l_password'])) {
	$username = htmlspecialchars($_POST['l_username']);
	$account_exist = $bdd->prepare('SELECT id,password FROM users WHERE username = ?');
	$account_exist->execute(array($username));

	if($account_exist->rowCount() == 1) {
		$account_infos = $account_exist->fetch();
		if(password_verify($_POST['l_password'], $account_infos->password)) {
			$_SESSION['id'] = $account_infos->id;
			echo 'ok';
		} else {
			echo 'Mot de passe incorrect.';
		}
	} else {
		echo 'Ce compte n\'existe pas.';
	}
} else {
	echo 'Merci de remplir tous les champs.';
}