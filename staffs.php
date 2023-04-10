<?php
require('global.php');
$page = 'staffs';
// Liste des categorie_id :
// Gestion : 1
// Administration : 2
// Édition : 3
// Animation : 4
// Évènementiel : 5
// Communication : 6
// Création : 7
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - L'équipe</title>
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
		<div class="row">
			<!-- LEFT -->
			<div class="col-lg-7 col-md-6 col-sm-12">
				<!-- GESTION -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/staffs/gestion.gif">
						<h1>Gestion</h1>
					</div>
					<div class="row">
						<?php
						$staff = $bdd->prepare('SELECT * FROM users_staffs WHERE categorie_id = ? ORDER BY position DESC');
						$staff->execute(array(1));
						while($staff_infos = $staff->fetch()) {
							$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							$user->execute(array($staff_infos->user_id));
							$user_infos = $user->fetch();
						?>
						<div class="col-lg-6 col-sm-12">
							<a href="#" class="staff">
								<div class="staff__avatar">
									<img src="https://api.habbocity.me/avatar_image.php?user=<?= $user_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
								</div>
								<div class="staff__infos">
									<h1><?= $user_infos->username; ?></h1>
									<h2><?= $staff_infos->fonction; ?></h2>
								</div>
								<img src="./assets/imgs/staffs/<?= $staff_infos->badge; ?>.gif" class="staff__badge">
							</a>
						</div>
						<?php } if($staff->rowCount() == 0) { ?>
							<center>Aucun staff dans cette catégorie !</center>
						<?php } ?>
					</div>
				</div>
				<!-- ADMIN -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/staffs/admin.gif">
						<h1>Administration</h1>
					</div>
					<div class="row">
						<?php
						$staff = $bdd->prepare('SELECT * FROM users_staffs WHERE categorie_id = ? ORDER BY position DESC');
						$staff->execute(array(2));
						while($staff_infos = $staff->fetch()) {
							$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							$user->execute(array($staff_infos->user_id));
							$user_infos = $user->fetch();
						?>
						<div class="col-lg-6 col-sm-12">
							<a href="#" class="staff">
								<div class="staff__avatar">
									<img src="https://api.habbocity.me/avatar_image.php?user=<?= $user_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
								</div>
								<div class="staff__infos">
									<h1><?= $user_infos->username; ?></h1>
									<h2><?= $staff_infos->fonction; ?></h2>
								</div>
								<img src="./assets/imgs/staffs/<?= $staff_infos->badge; ?>.gif" class="staff__badge">
							</a>
						</div>
						<?php } if($staff->rowCount() == 0) { ?>
							<center>Aucun staff dans cette catégorie !</center>
						<?php } ?>
					</div>
				</div>
				<!-- ÉDITION -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/staffs/edition.gif">
						<h1>Édition</h1>
					</div>
					<div class="row">
						<?php
						$staff = $bdd->prepare('SELECT * FROM users_staffs WHERE categorie_id = ? ORDER BY position DESC');
						$staff->execute(array(3));
						while($staff_infos = $staff->fetch()) {
							$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							$user->execute(array($staff_infos->user_id));
							$user_infos = $user->fetch();
						?>
						<div class="col-lg-6 col-sm-12">
							<a href="#" class="staff">
								<div class="staff__avatar">
									<img src="https://api.habbocity.me/avatar_image.php?user=<?= $user_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
								</div>
								<div class="staff__infos">
									<h1><?= $user_infos->username; ?></h1>
									<h2><?= $staff_infos->fonction; ?></h2>
								</div>
								<img src="./assets/imgs/staffs/<?= $staff_infos->badge; ?>.gif" class="staff__badge">
							</a>
						</div>
						<?php } if($staff->rowCount() == 0) { ?>
							<center>Aucun staff dans cette catégorie !</center>
						<?php } ?>
					</div>
				</div>
			</div>

			<!-- RIGHT -->
			<div class="col-lg-5 col-md-6 col-sm-12">
				<!-- ANIMATION -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/staffs/anim.gif">
						<h1>Animation</h1>
					</div>
					<div class="row">
						<?php
						$staff = $bdd->prepare('SELECT * FROM users_staffs WHERE categorie_id = ? ORDER BY position DESC');
						$staff->execute(array(4));
						while($staff_infos = $staff->fetch()) {
							$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							$user->execute(array($staff_infos->user_id));
							$user_infos = $user->fetch();
						?>
						<div class="col-lg-6 col-sm-12">
							<a href="#" class="staff">
								<div class="staff__avatar">
									<img src="https://api.habbocity.me/avatar_image.php?user=<?= $user_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
								</div>
								<div class="staff__infos">
									<h1><?= $user_infos->username; ?></h1>
									<h2><?= $staff_infos->fonction; ?></h2>
								</div>
								<img src="./assets/imgs/staffs/<?= $staff_infos->badge; ?>.gif" class="staff__badge">
							</a>
						</div>
						<?php } if($staff->rowCount() == 0) { ?>
							<center>Aucun staff dans cette catégorie !</center>
						<?php } ?>
					</div>
				</div>
				<!-- Évènementiel -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/staffs/event.gif">
						<h1>Évènementiel</h1>
					</div>
					<div class="row">
						<?php
						$staff = $bdd->prepare('SELECT * FROM users_staffs WHERE categorie_id = ? ORDER BY position DESC');
						$staff->execute(array(5));
						while($staff_infos = $staff->fetch()) {
							$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							$user->execute(array($staff_infos->user_id));
							$user_infos = $user->fetch();
						?>
						<div class="col-lg-6 col-sm-12">
							<a href="#" class="staff">
								<div class="staff__avatar">
									<img src="https://api.habbocity.me/avatar_image.php?user=<?= $user_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
								</div>
								<div class="staff__infos">
									<h1><?= $user_infos->username; ?></h1>
									<h2><?= $staff_infos->fonction; ?></h2>
								</div>
								<img src="./assets/imgs/staffs/<?= $staff_infos->badge; ?>.gif" class="staff__badge">
							</a>
						</div>
						<?php } if($staff->rowCount() == 0) { ?>
							<center>Aucun staff dans cette catégorie !</center>
						<?php } ?>
					</div>
				</div>
				<!-- COMMUNICATION -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/staffs/com.gif">
						<h1>Communication</h1>
					</div>
					<div class="row">
						<?php
						$staff = $bdd->prepare('SELECT * FROM users_staffs WHERE categorie_id = ? ORDER BY position DESC');
						$staff->execute(array(6));
						while($staff_infos = $staff->fetch()) {
							$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							$user->execute(array($staff_infos->user_id));
							$user_infos = $user->fetch();
						?>
						<div class="col-lg-6 col-sm-12">
							<a href="#" class="staff">
								<div class="staff__avatar">
									<img src="https://api.habbocity.me/avatar_image.php?user=<?= $user_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
								</div>
								<div class="staff__infos">
									<h1><?= $user_infos->username; ?></h1>
									<h2><?= $staff_infos->fonction; ?></h2>
								</div>
								<img src="./assets/imgs/staffs/<?= $staff_infos->badge; ?>.gif" class="staff__badge">
							</a>
						</div>
						<?php } if($staff->rowCount() == 0) { ?>
							<center>Aucun staff dans cette catégorie !</center>
						<?php } ?>
					</div>
				</div>
				<!-- CREATION -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/staffs/artiste.gif">
						<h1>Création</h1>
					</div>
					<div class="row">
						<?php
						$staff = $bdd->prepare('SELECT * FROM users_staffs WHERE categorie_id = ? ORDER BY position DESC');
						$staff->execute(array(7));
						while($staff_infos = $staff->fetch()) {
							$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							$user->execute(array($staff_infos->user_id));
							$user_infos = $user->fetch();
						?>
						<div class="col-lg-6 col-sm-12">
							<a href="#" class="staff">
								<div class="staff__avatar">
									<img src="https://api.habbocity.me/avatar_image.php?user=<?= $user_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
								</div>
								<div class="staff__infos">
									<h1><?= $user_infos->username; ?></h1>
									<h2><?= $staff_infos->fonction; ?></h2>
								</div>
								<img src="./assets/imgs/staffs/<?= $staff_infos->badge; ?>.gif" class="staff__badge">
							</a>
						</div>
						<?php } if($staff->rowCount() == 0) { ?>
							<center>Aucun staff dans cette catégorie !</center>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require('./models/footer.php'); ?>

	<script type="text/javascript" src="./assets/js/submenu.js"></script>
	<script type="text/javascript" src="./assets/js/nav.js"></script>

</body>
</html>