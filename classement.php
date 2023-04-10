<?php
require('global.php');
$page = 'classement';
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Classement</title>
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
			<!-- TOP GAMER -->
			<div class="col-lg-6 col-md-12 col-sm-12">
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/video-game_1f3ae.png">
						<h1>Top gamer</h1>
					</div>
					<?php
					$top_gamer = $bdd->prepare('SELECT * FROM users WHERE points_gamer >= ? ORDER BY points_gamer DESC LIMIT 3');
					$top_gamer->execute(array(1));
					$count = 0;
					while($top_gamer_infos = $top_gamer->fetch()) {
						$count = $count + 1;
					?>
					<div class="user-list">
						<div class="user-list__profil">
							<?php if($count == 1) { ?>
							<img src="./assets/imgs/emojis/1st-place-medal_1f947.png" class="user-list__place">
							<?php } elseif($count == 2) { ?>
							<img src="./assets/imgs/emojis/2nd-place-medal_1f948.png" class="user-list__place">
							<?php } elseif($count == 3) { ?>
							<img src="./assets/imgs/emojis/3rd-place-medal_1f949.png" class="user-list__place">
							<?php } ?>
							<div class="user-list__avatar">
								<img src="https://api.habbocity.me/avatar_image.php?user=<?= $top_gamer_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
							</div>
							<p><?= $top_gamer_infos->username; ?></p>
						</div>
						<div class="user-list__info"><span><?= $top_gamer_infos->points_gamer; ?></span> Points</div>
					</div>
					<?php } if($top_gamer->rowCount() == 0) { ?>
						<center>Personne pour le moment !</center>
					<?php } ?>
				</div>
			</div>
			<!-- TOP RICHESSE -->
			<div class="col-lg-6 col-md-12 col-sm-12">
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/money-bag_1f4b0.png">
						<h1>Top Richesse</h1>
					</div>
					<?php
					$top_gamer = $bdd->prepare('SELECT * FROM users WHERE arcade_coins >= ? ORDER BY arcade_coins DESC LIMIT 3');
					$top_gamer->execute(array(1));
					$count = 0;
					while($top_gamer_infos = $top_gamer->fetch()) {
						$count = $count + 1;
					?>
					<div class="user-list">
						<div class="user-list__profil">
							<?php if($count == 1) { ?>
							<img src="./assets/imgs/emojis/1st-place-medal_1f947.png" class="user-list__place">
							<?php } elseif($count == 2) { ?>
							<img src="./assets/imgs/emojis/2nd-place-medal_1f948.png" class="user-list__place">
							<?php } elseif($count == 3) { ?>
							<img src="./assets/imgs/emojis/3rd-place-medal_1f949.png" class="user-list__place">
							<?php } ?>
							<div class="user-list__avatar">
								<img src="https://api.habbocity.me/avatar_image.php?user=<?= $top_gamer_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
							</div>
							<p><?= $top_gamer_infos->username; ?></p>
						</div>
						<div class="user-list__info"><span><?= $top_gamer_infos->arcade_coins; ?></span> ArcadeCoins</div>
					</div>
					<?php } if($top_gamer->rowCount() == 0) { ?>
						<center>Personne pour le moment !</center>
					<?php } ?>
				</div>
			</div>
			<!-- TOP BADGES -->
			<div class="col-lg-4 col-md-12 col-sm-12" style="display: none;">
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/performing-arts_1f3ad.png">
						<h1>Top Badges</h1>
					</div>
					<div class="user-list">
						<div class="user-list__profil">
							<img src="./assets/imgs/emojis/1st-place-medal_1f947.png" class="user-list__place">
							<div class="user-list__avatar">
								<img src="https://api.habbocity.me/avatar_image.php?user=Kaana&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
							</div>
							<p>Kaana</p>
						</div>
						<div class="user-list__info"><span>150</span> Points</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require('./models/footer.php'); ?>

	<script type="text/javascript" src="./assets/js/submenu.js"></script>
	<script type="text/javascript" src="./assets/js/fluxAdd.js"></script>
	<script type="text/javascript" src="./assets/js/nav.js"></script>

</body>
</html>