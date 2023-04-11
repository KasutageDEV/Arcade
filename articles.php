<?php
require('global.php');
require('./php/functions/Date.php');
$page = 'articles';
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Tous nos articles</title>
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
			<?php
			$currentDate = date('Y-m-d H:i:s');
			$last_news = $bdd->prepare('SELECT * FROM articles WHERE date_publication <= ? AND etat = ? ORDER BY date_publication DESC LIMIT 3');
			$last_news->execute(array($currentDate, 3));
			while($last_news_infos = $last_news->fetch()) {
			?>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<a href="./articles_view?id=<?= $last_news_infos->id; ?>" class="article">
					<div class="row d-flex align-items-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<img src="./imagesArticle/<?= $last_news_infos->image; ?>" class="article__img">
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 p-4">
							<h1 class="article__title"><?= $last_news_infos->titre; ?></h1>
							<h2 class="article__subtitle"><?= $last_news_infos->description; ?></h2>
							<div class="article__infos">
								<img src="./assets/imgs/emojis/one-oclock_1f550.png">
								<p><span><?= formater_date($last_news_infos->date_post); ?></span></p>
							</div>
							<div class="article__infos">
								<img src="./assets/imgs/emojis/black-nib_2712-fe0f.png">
								<p>Écrit par <span><?= $last_news_infos->author; ?></span></p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php } if($last_news->rowCount() == 0) { ?>
				<center>Aucun article pour le moment !</center>
			<?php } ?>
		</div>
	</div>

	<?php require('./models/footer.php'); ?>

	<script type="text/javascript" src="./assets/js/submenu.js"></script>
	<script type="text/javascript" src="./assets/js/nav.js"></script>

</body>
</html>