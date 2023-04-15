<?php
require('global.php');
require('./php/functions/Date.php');
$page = 'dedicace';

if(isset($_POST['submit__dedicace'])) {
	if(!empty($_POST['dedicace'])) {
		$dedicace 	= htmlspecialchars($_POST['dedicace']);
		$date 		= date('d-m-Y H:i:s');

		$insert = $bdd->prepare('INSERT INTO dedicaces(user_id, message, date, etat) VALUES(?, ?, ?, ?)');
		$insert->execute(array($session_infos->id, $dedicace, $date, 1));

		$validate = 'Votre dédicaces à bien été envoyer et est en attente de validation !';
	} else {
		$erreur = 'Vous devez entrer un message !';
	}
}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Postez votre dédicace</title>
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
	<!-- OG -->
	<meta property="og:title" content="Arcade - Toute l'actualité de HabboCity" />
	<meta property="og:description" content="Arcade - Suis toute l'actualité de HabboCity et bien plus !" />
	<meta property="og:site_name" content="Arcade" />
	<meta property="og:image" content="" />
	<meta property="og:locale" content="fr_FR" />
	<meta property="og:url" content="https://www.arcade.fr" />
	<!-- FACEBOOK -->
	<meta property="fb:page_id" content="" />
	<!-- TWITTER -->
	<meta name="twitter:title" content="Arcade - Toute l'actualité de HabboCity" />
	<meta name="twitter:description" content="Arcade - Suis toute l'actualité de HabboCity et bien plus !" />
	<meta name="twitter:site" content="@ArcadeFR" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:image:src" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:domain" content="https://www.arcade.fr" />
	<!-- FONTAWESOME -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="./assets/css/global.css">
	<!-- SWEETALERT -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

	<?php require('./models/header.php'); ?>

	<div class="container">
		<?php if(isset($_SESSION['id'])) { ?>
		<div class="row">
			<!-- LEFT -->
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis-mt/black-nib_2712-fe0f.png">
						<h1>Poster une dédicace</h1>
					</div>
					<form method="POST" action="">
						<input type="text" name="dedicace" placeholder="Votre dédicace (Max: 150 caractères)" class="dedicaces__input">
						<button type="submit" name="submit__dedicace" class="dedicaces__submit">Envoyer la dédicace en vérification</button>
					</form>
				</div>
				<!-- 10 Dernière dédicace -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis-mt/clipboard_1f4cb.png">
						<h1>Dernières dedicaces envoyées</h1>
					</div>
					<?php
					$dedicace = $bdd->prepare('SELECT * FROM dedicaces WHERE etat = ? ORDER BY id DESC LIMIT 5');
					$dedicace->execute(array(2));
					while($dedicace_infos = $dedicace->fetch()) {
						$userD = $bdd->prepare('SELECT * FROM users WHERE id = ?');
						$userD->execute(array($dedicace_infos->user_id));
						$userD_infos = $userD->fetch();
					?>
					<div class="user-list">
						<div class="user-list__profil">
							<div class="user-list__avatar">
								<img src="https://api.habbocity.me/avatar_image.php?user=<?= $userD_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
							</div>
							<p><?= $userD_infos->username; ?></p>
						</div>
						<div class="user-list__info"><span><?= formater_date($dedicace_infos->date); ?></span></div>
					</div>
					<?php } ?>
				</div>
			</div>
			<!-- RIGHT -->
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis-mt/eye-in-speech-bubble_1f441-fe0f-200d-1f5e8-fe0f.png">
						<h1>Mes dédicaces</h1>
					</div>
					<?php
					$my_dedicace = $bdd->prepare('SELECT * FROM dedicaces WHERE user_id = ? ORDER BY id DESC');
					$my_dedicace->execute(array($session_infos->id));
					while($my_dedicace_infos = $my_dedicace->fetch()) {
					?>
					<div class="user-list">
						<div class="user-list__profil">
							<div class="user-list__avatar">
								<img src="https://api.habbocity.me/avatar_image.php?user=<?= $session_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
							</div>
							<p><?= $session_infos->username; ?></p>
						</div>
						<?php if($my_dedicace_infos->etat == 1) { ?>
							<div class="user-list__badge warning">En attente</div>
						<?php } if($my_dedicace_infos->etat == 2) { ?>
							<div class="user-list__badge success">En ligne</div>
						<?php } if($my_dedicace_infos->etat == 3) { ?>
							<div class="user-list__badge danger">Refusée</div>
						<?php } ?>
						<div class="user-list__info"><span><?= formater_date($my_dedicace_infos->date); ?></span></div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } else { ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="alert danger">Vous devez être connecté pour posté une dédicace !</div>
			</div>
		</div>
		<?php } ?>
	</div>

	<?php require('./models/footer.php'); ?>

	<script type="text/javascript" src="./assets/js/submenu.js"></script>
	<script type="text/javascript" src="./assets/js/nav.js"></script>

</body>
</html>