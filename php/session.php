<?php
session_start();

if(isset($_SESSION['id'])) {
	$account_id = $bdd->prepare('SELECT * FROM users WHERE id = ?');
	$account_id->execute(array($_SESSION['id']));

	if($account_id->rowCount() == 1) {
		$session_infos = $account_id->fetch();
		$_SESSION['id'] = $session_infos->id;
		$nouvelle_ip = $bdd->prepare('UPDATE users SET ip_last = ? WHERE id = ?');
      	$nouvelle_ip->execute(array($_SERVER['REMOTE_ADDR'], $_SESSION['id']));

      	if($session_infos->is_ban == 1) {
			header('Refresh:3; url=/logout');
			die('Votre compte à été désactivé par un administrateur.');
		}
	} else {
		header('Location: /logout');
		exit();
	}
}
?>