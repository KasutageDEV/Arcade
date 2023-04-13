<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'index';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_index == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$nbrCorrection = $bdd->prepare('SELECT * FROM articles WHERE etat = ?');
$nbrCorrection->execute(array(1));
$count_nbrCorrection = $nbrCorrection->rowCount();

$nbrValidation = $bdd->prepare('SELECT * FROM articles WHERE etat = ?');
$nbrValidation->execute(array(2));
$count_nbrValidation = $nbrValidation->rowCount();

$nbrDedicaces = $bdd->prepare('SELECT * FROM dedicaces WHERE etat = ?');
$nbrDedicaces->execute(array(1));
$count_nbrDedicaces = $nbrDedicaces->rowCount();

if(isset($_POST['submit__information'])) {
	if(!empty($_POST['message'])) {
		$message 	= htmlspecialchars($_POST['message']);
		$date 		= date('d-m-Y H:i:s');

		$update = $bdd->prepare('UPDATE settings SET information = ?');
		$update->execute(array($message));

		$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    	$logs->execute(array($session_infos->id, 'à modifier l\'information', $date));

    	$validate = 'Vous avez bien modifier la notification !';
	} else {
		$erreur = 'La notification ne peux être vide !';
	}
}

if(isset($_GET['reset-topgamer'])) {
	if($verifPage_infos->classement == 1) {
		$date = date('d-m-Y H:i:s');
		
		$reset = $bdd->prepare('UPDATE users SET points_gamer = ?');
		$reset->execute(array(0));

		$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    	$logs->execute(array($session_infos->id, 'à remis à 0 le top gamer', $date));

    	$validate = 'Vous avez bien remis à 0 le Top Gamer !';
	} else {
		$erreur = 'Vous n\'êtes pas autorisé à remettre le top gamer à 0';
	}
}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Admin</title>
	<!-- GENERAL -->
	<meta name="robots" content="index" />
	<meta name="keywords" content="habbo, habbo hotel, habbocity, habbo city, habbo alpha, habboalpha, habboz, habbox, habboo, rétro, rétro habbo, bobbalive, adohotel, bobbahotel, habbix, jeu en ligne, serveur habbo, communauté, avatar, jeu" />
	<meta name="description" content="Arcade - Suis toute l'actualité de HabboCity et bien plus !" />
	<meta name="Geography" content="France" />
	<meta name="country" content="France" />
	<meta hreflang="fr" name="Language" content="French" />
	<meta name="Copyright" content="Arcade" />
	<meta name="language" content="fr-FR" />
	<meta name="category" content="Website">
	<meta name="reply-to" content="contact@arcade.fr">
	<meta name="Author" content="Kasutage" />
	<!-- FONTAWESOME -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="./assets/css/global.css">
</head>
<body>

	<div class="wrapper">
		<div class="dashboard">
			<?php require('./models/header.php'); ?>
			<div class="dashboard__body">
				<div class="dashboard__content">
					<?php if(isset($validate)) { ?>
					<div class="alert success"><?= $validate; ?></div>
					<?php } if(isset($erreur)) { ?>
					<div class="alert danger"><?= $erreur; ?></div>
					<?php } ?>
					<div class="link__content">
						<?php if($verifPage_infos->page_articleAdd == 1) { ?>
						<a href="./article-add" class="link">
							<div class="link__image warning">
								<i class="fas fa-keyboard"></i>
							</div>
							<p>Créer un article</p>
						</a>
						<?php } if($verifPage_infos->page_articleCorrect == 1) { ?>
						<a href="./article-correct" class="link">
							<div class="link__image warning">
								<?php if($count_nbrCorrection >= 1) { ?>
								<div class="link__notif"><?= $count_nbrCorrection; ?></div>
								<?php } ?>
								<i class="fas fa-pen-to-square"></i>
							</div>
							<p>Corriger un article</p>
						</a>
						<?php } if($verifPage_infos->page_articleList == 1) { ?>
						<a href="./article-list" class="link">
							<div class="link__image warning">
								<i class="fas fa-clipboard-list"></i>
							</div>
							<p>Gestion des articles</p>
						</a>
						<?php } if($verifPage_infos->page_articleValid == 1) { ?>
						<a href="./article-valid" class="link">
							<div class="link__image danger">
								<?php if($count_nbrValidation >= 1) { ?>
								<div class="link__notif"><?= $count_nbrValidation; ?></div>
								<?php } ?>
								<i class="fas fa-check-to-slot"></i>
							</div>
							<p>Valider un article</p>
						</a>
						<?php } if($verifPage_infos->page_userRank == 1) { ?>
						<a href="./user-rank" class="link">
							<div class="link__image success">
								<i class="fas fa-user-plus"></i>
							</div>
							<p>Rank</p>
						</a>
						<?php } if($verifPage_infos->page_userList == 1) { ?>
						<a href="./user-list" class="link">
							<div class="link__image success">
								<i class="fas fa-user-cog"></i>
							</div>
							<p>Gestion des membres</p>
						</a>
						<?php } if($verifPage_infos->page_partenaires == 1) { ?>
						<a href="./partenaires" class="link">
							<div class="link__image green">
								<i class="fas fa-handshake-simple"></i>
							</div>
							<p>Gestion des partenaires</p>
						</a>
						<?php } if($verifPage_infos->page_dedicaces == 1) { ?>
						<a href="./dedicaces" class="link">
							<div class="link__image pink">
								<?php if($count_nbrDedicaces >= 1) { ?>
								<div class="link__notif"><?= $count_nbrDedicaces; ?></div>
								<?php } ?>
								<i class="fas fa-comments"></i>
							</div>
							<p>Gestion des dédicaces</p>
						</a>
						<?php } if($verifPage_infos->page_event == 1) { ?>
						<a href="./event" class="link">
							<div class="link__image gray">
								<i class="fas fa-pen-to-square"></i>
							</div>
							<p>Gestion des events HC</p>
						</a>
						<?php } if($verifPage_infos->page_flux == 1) { ?>
						<a href="./flux" class="link">
							<div class="link__image pruple">
								<i class="fas fa-clipboard-list"></i>
							</div>
							<p>Gestion des flux</p>
						</a>
						<?php } if($verifPage_infos->page_apropos == 1) { ?>
						<a href="./a-propos" class="link">
							<div class="link__image blue">
								<i class="fas fa-question"></i>
							</div>
							<p>Page à propos</p>
						</a>
						<?php } if($verifPage_infos->page_bannis == 1) { ?>
						<a href="./bannis" class="link">
							<div class="link__image danger">
								<i class="fas fa-ban"></i>
							</div>
							<p>Gestion des bannis</p>
						</a>
						<?php } if($verifPage_infos->classement == 1) { ?>
						<a href="?reset-topgamer" class="link">
							<div class="link__image danger">
								<i class="fas fa-arrow-rotate-left"></i>
							</div>
							<p>Top Gamer à 0</p>
						</a>
						<?php } ?>
					</div>
					<div class="row">
						<?php if($verifPage_infos->notification == 1) { ?>
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="dashboard__title">
								<i class="fas fa-pen-to-square"></i>
								<h1>Modifier la notification</h1>
							</div>
							<div class="notification">
								<form method="POST" action="">
									<textarea name="message"><?= $website_infos->information; ?></textarea>
									<button type="submit" name="submit__information">Mettre à jour</button>
								</form>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php require('./models/logs-bar.php'); ?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="./assets/js/date.js"></script>
</body>
</html>