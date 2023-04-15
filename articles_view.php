<?php
require('global.php');
require('./php/functions/Date.php');
$page = 'articles';
if(isset($_GET['id']) AND !empty($_GET['id'])) {
	$id = intval($_GET['id']);
	$article = $bdd->prepare('SELECT * FROM articles WHERE id = ? AND etat = ?');
	$article->execute(array($id, 3));
	if($article->rowCount() == 1) {
	} else {
		$article = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 0,1');
	}
} else {
	$article = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 0,1');
}
$article_infos = $article->fetch();

$user = $bdd->prepare('SELECT * FROM users WHERE username = ?');
$user->execute(array($article_infos->author));
$user_infos = $user->fetch();
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
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h1 class="articleView__title"><?= $article_infos->titre; ?></h1>
				<h2 class="articleView__subtitle"><?= $article_infos->description; ?></h2>
				<div class="articleView__head">
					<div class="articleView__autor">
						<div class="user-list__avatar">
							<img src="https://api.habbocity.me/avatar_image.php?user=<?= $article_infos->author; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
						</div>
						<div class="cardView__autor-info">
							<p><?= $article_infos->author; ?></p>
							<p><?= formater_date($article_infos->date_post); ?></p>
						</div>
					</div>
					<ul>
						<li>Partager :</li>
						<li>
							<a href="https://twitter.com/intent/tweet?url=<?= $website_infos->link; ?>/articles_view?id=<?= $article_infos->id; ?>&text=<?= $article_infos->titre; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
						</li>
						<li>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?= $website_infos->link; ?>/articles_view?id=<?= $article_infos->id; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
						</li>
						<li>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $website_infos->link; ?>/articles_view?id=<?= $article_infos->id; ?>&title=<?= $article_infos->titre; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
						</li>
						<li>
							<a href="https://pinterest.com/pin/create/button/?url=<?= $website_infos->link; ?>/articles_view?id=<?= $article_infos->id; ?>&media=<?= $website_infos->link; ?>/imagesArticle/<?= $article_infos->image; ?>&description=<?= $article_infos->description; ?>" target="_blank"><i class="fab fa-pinterest"></i></a>
						</li>
					</ul>
				</div>
				<div class="articleView__illustration" style="background-image: url('./imagesArticle/<?= $article_infos->image; ?>');"></div>
				<div class="about">
					<?= html_entity_decode($article_infos->contenu); ?>
				</div>
			</div>
		</div>
	</div>

	<?php require('./models/footer.php'); ?>

	<script type="text/javascript" src="./assets/js/submenu.js"></script>
	<script type="text/javascript" src="./assets/js/nav.js"></script>

</body>
</html>