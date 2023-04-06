<?php
$website = $bdd->prepare('SELECT * FROM settings WHERE id = ?');
$website->execute(array(1));
if($website->rowCount() == 1) {
	$website_infos = $website->fetch();
	if(!isset($pasdemtnc)) {
		if($website_infos->maintenance == 1) {
			if(isset($_SESSION['id'])) {
				if($session_infos->rank <= 5) {
					header('Location: /logout');
					exit();
				}
			} else {
				header('Location: /maintenance');
				exit();
			}
		}
	}
} else {
	die('Une erreur est survenue (<b>#604105</b>), contactez Kasutage en cliquant <a href="https://www.instagram.com/m_vasbien/">ici</a>.');
}
?>