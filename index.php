<?php
require('global.php');
$page = 'index';
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Toute l'actualité de HabboCity</title>
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
	<meta property="og:url" content="<?= $website_infos->link; ?>" />
	<!-- FACEBOOK -->
	<meta property="fb:page_id" content="" />
	<!-- TWITTER -->
	<meta name="twitter:title" content="Arcade - Toute l'actualité de HabboCity" />
	<meta name="twitter:description" content="Arcade - Suis toute l'actualité de HabboCity et bien plus !" />
	<meta name="twitter:site" content="@ArcadeFR" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:image:src" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:domain" content="<?= $website_infos->link; ?>" />
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
			<div class="col-lg-8 col-md-6 col-sm-12">
				<!-- DERNIER ARTICLES -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/newspaper_1f4f0.png">
						<h1>Derniers articles</h1>
					</div>
					<div class="last-news">
						<img src="https://cdn.wibbo.org/web-promo/lpromo_1505_hosp.png" class="last-news__img">
						<div class="last-news__content">
							<h1>Titre de l'article</h1>
							<h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</h2>
							<div class="last-news__infos">
								<img src="./assets/imgs/emojis/one-oclock_1f550.png">
								<p>Il y a <span>2j</span></p>
							</div>
							<div class="last-news__infos">
								<img src="./assets/imgs/emojis/black-nib_2712-fe0f.png">
								<p>Écrit par <span>Kasutage</span></p>
							</div>
						</div>
					</div>
				</div>
				<!-- ARTICLE HABBOCITY -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/calendar_1f4c5.png">
						<h1>À suivre sur HabboCity</h1>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="news-hc" style="background-image: url('https://cdn.wibbo.org/web-promo/lpromo_1505_hosp.png');">
								<div class="news-hc__bg"></div>
								<div class="news-hc__zindex">
									<div class="news-hc__badge"># Jeu</div>
									<h1>Titre de l'article</h1>
									<h2>Publié par <span>Newart</span></h2>
									<a href="#">Voir l'article</a>
								</div>
								<img src="https://api.habbocity.me/avatar_image.php?user=Kaana&headonly=0&direction=2&head_direction=2&size=n">
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- RIGHT -->
			<div class="col-lg-4 col-md-6 col-sm-12">
				<!-- INFORMATION -->
				<?php if($website_infos->is_information == 1){ ?>
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/pushpin_1f4cc.png">
						<h1>Information</h1>
					</div>
					<div class="information__contenu">
						<?= $website_infos->information; ?>
					</div>
				</div>
				<?php } ?>
				<!-- Top Gamer -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/trophy_1f3c6.png">
						<h1>Top gamer</h1>
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
				<!-- Dernier inscrits -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/waving-hand_1f44b.png">
						<h1>Derniers inscrits</h1>
					</div>
					<div class="user-list">
						<div class="user-list__profil">
							<div class="user-list__avatar">
								<img src="https://api.habbocity.me/avatar_image.php?user=Kaana&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
							</div>
							<p>Kaana</p>
						</div>
						<div class="user-list__info">Il y a <span>2j</span></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<!-- Feed insta -->
				<div class="bloc">
					<div class="bloc__title">
						<img src="./assets/imgs/emojis/mobile-phone_1f4f1.png">
						<h1>Feed Instagram</h1>
					</div>
					<center>Bientôt disponible</center>
				</div>
			</div>
		</div>
	</div>

	<?php require('./models/footer.php'); ?>

	<script type="text/javascript" src="./assets/js/submenu.js"></script>
	<script type="text/javascript" src="./assets/js/nav.js"></script>

</body>
</html>