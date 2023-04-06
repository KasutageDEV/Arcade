<?php
require('../global.php');
require('./php/functions/VerifPage.php');
$page = 'index';
$verif = 'page_index';

if(!isset($_SESSION['id'])) {
    header('Location: '.$website_infos->link.'/index');
    exit();
} elseif(isset($_SESSION['id'])) {
    VerifPage($session_infos->id, $verif);
}

$accesAuxPages = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$accesAuxPages->execute(array($session_infos->id));
$accesAuxPages_infos = $accesAuxPages->fetch();
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
					<div class="link__content">
						<?php if($accesAuxPages_infos->page_articleAdd == 1) { ?>
						<a href="./article-add" class="link">
							<div class="link__image warning">
								<i class="fas fa-keyboard"></i>
							</div>
							<p>Créer un article</p>
						</a>
						<?php } if($accesAuxPages_infos->page_articleCorrect == 1) { ?>
						<a href="./article-correct" class="link">
							<div class="link__image warning">
								<div class="link__notif">2</div>
								<i class="fas fa-pen-to-square"></i>
							</div>
							<p>Corriger un article</p>
						</a>
						<?php } if($accesAuxPages_infos->page_articleList == 1) { ?>
						<a href="./article-list" class="link">
							<div class="link__image warning">
								<i class="fas fa-clipboard-list"></i>
							</div>
							<p>Gestion des articles</p>
						</a>
						<?php } if($accesAuxPages_infos->page_articleValid == 1) { ?>
						<a href="./article-valid" class="link">
							<div class="link__image danger">
								<div class="link__notif">4</div>
								<i class="fas fa-check-to-slot"></i>
							</div>
							<p>Valider un article</p>
						</a>
						<?php } if($accesAuxPages_infos->page_userRank == 1) { ?>
						<a href="./user-rank" class="link">
							<div class="link__image success">
								<i class="fas fa-user-plus"></i>
							</div>
							<p>Rank</p>
						</a>
						<?php } if($accesAuxPages_infos->page_userList == 1) { ?>
						<a href="./user-list" class="link">
							<div class="link__image success">
								<i class="fas fa-user-cog"></i>
							</div>
							<p>Gestion des membres</p>
						</a>
						<?php } if($accesAuxPages_infos->page_dedicaces == 1) { ?>
						<a href="./dedicaces" class="link">
							<div class="link__image pink">
								<div class="link__notif">6</div>
								<i class="fas fa-comments"></i>
							</div>
							<p>Gestion des dédicaces</p>
						</a>
						<?php } if($accesAuxPages_infos->page_event == 1) { ?>
						<a href="./event" class="link">
							<div class="link__image gray">
								<i class="fas fa-pen-to-square"></i>
							</div>
							<p>Gestion des events HC</p>
						</a>
						<?php } if($accesAuxPages_infos->page_flux == 1) { ?>
						<a href="./flux" class="link">
							<div class="link__image pruple">
								<i class="fas fa-clipboard-list"></i>
							</div>
							<p>Gestion des flux</p>
						</a>
						<?php } if($accesAuxPages_infos->page_apropos == 1) { ?>
						<a href="./a-propos" class="link">
							<div class="link__image blue">
								<i class="fas fa-question"></i>
							</div>
							<p>Page à propos</p>
						</a>
						<?php } if($accesAuxPages_infos->page_bannis == 1) { ?>
						<a href="./bannis" class="link">
							<div class="link__image danger">
								<i class="fas fa-ban"></i>
							</div>
							<p>Gestion des bannis</p>
						</a>
						<?php } ?>
					</div>
					<div class="row">
						<?php if($accesAuxPages_infos->classement == 1) { ?>
						<div class="col-lg-7 col-md-6 col-sm-12">
							<div class="dashboard__title">
								<i class="fas fa-trophy"></i>
								<h1>Gestion des classements</h1>
							</div>
							<div class="classement">
								<a href="#">Réinitialiser le Top Gamer</a>
								<a href="#">Réinitialiser le Top Badges</a>
								<a href="#">Réinitialiser le Top Richesse</a>
							</div>
						</div>
						<?php } if($accesAuxPages_infos->notification == 1) { ?>
						<div class="col-lg-5 col-md-6 col-sm-12">
							<div class="dashboard__title">
								<i class="fas fa-pen-to-square"></i>
								<h1>Modifier la notification</h1>
							</div>
							<div class="notification">
								<form method="POST" action="">
									<textarea name="message"><?= $website_infos_notification; ?></textarea>
									<button type="submit">Mettre à jour</button>
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