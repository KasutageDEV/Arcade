<?php
require('global.php');
$page = 'flux';
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Suivez tous les flux d'HabboCity et même ceux d'Arcade</title>
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
	<!-- JQUERY -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css">
  	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  	<!-- SWEETALERT -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>

	<?php require('./models/header.php'); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="flux">
					<div class="flux__info">
						<div class="flux__user">
							<div class="flux__avatar">
								<img src="https://api.habbocity.me/avatar_image.php?user=Kaana&headonly=0&direction=2&head_direction=2&size=n">
							</div>
							<div class="flux__pseudo">
								<h1>Kaana</h1>
								<h2 class="success">Arrivée</h2>
							</div>
						</div>
						<img src="./assets/imgs/staffs-hc/adm.gif">
					</div>
					<div class="flux__update">
						<div class="flux__icon danger">
							<i class="fas fa-arrow-left"></i>
						</div>
						<p>Fondateur</p>
					</div>
					<div class="flux__update">
						<div class="flux__icon success">
							<i class="fas fa-arrow-right"></i>
						</div>
						<p>Développeur</p>
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