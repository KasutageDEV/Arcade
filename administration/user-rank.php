<?php
$page = 'user-rank';
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Rank un membre</title>
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
					<form method="POST" action="">
						<div class="row">
							<div class="col-lg-3 col-md-6 col-sm-12">
								<div class="dashboard__title">
									<i class="fas fa-clipboard-list"></i>
									<h1>Informations général</h1>
								</div>
								<div class="rank__group">
									<label>Pseudo</label>
									<input type="text" name="pseudo" placeholder="Pseudo" class="rank__input">
								</div>
								<div class="rank__group">
									<label>Fonction</label>
									<input type="text" name="fonction" placeholder="Fonction" class="rank__input">
								</div>
								<div class="rank__group">
									<label>Badge</label>
									<input type="text" name="badge" placeholder="Code du badge" class="rank__input">
								</div>
								<div class="rank__group">
									<label>Catégorie</label>
									<select name="categorie" class="rank__input">
										<option value="1">Gestion</option>
										<option value="2">Administrateur</option>
										<option value="3">Édition</option>
										<option value="4">Animation</option>
										<option value="5">Évènementiel</option>
										<option value="6">Communication</option>
										<option value="7">Création</option>
									</select>
								</div>
								<div class="rank__group">
									<label>Position</label>
									<input type="number" name="position" placeholder="Position dans la page staff" class="rank__input">
								</div>
							</div>
							<div class="col-lg-5 col-md-6 col-sm-12">
								<div class="dashboard__title">
									<i class="fas fa-clipboard-list"></i>
									<h1>Autorisation des pages</h1>
								</div>
								<div class="row">
									<div class="col-lg-6 col-sm-12">
										<div class="rank__choice">
											<p>Créer un article</p>
											<input type="checkbox" name="article-add" value="article-add" id="article-add">
											<label for="article-add"></label>
										</div>
										<div class="rank__choice">
											<p>Corriger un article</p>
											<input type="checkbox" name="article-correct" value="article-correct" id="article-correct">
											<label for="article-correct"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des articles</p>
											<input type="checkbox" name="article-list" value="article-list" id="article-list">
											<label for="article-list"></label>
										</div>
										<div class="rank__choice">
											<p>Valider un article</p>
											<input type="checkbox" name="article-valide" value="article-valide" id="article-valide">
											<label for="article-valide"></label>
										</div>
										<div class="rank__choice">
											<p>Rank</p>
											<input type="checkbox" name="user-rank" value="user-rank" id="user-rank">
											<label for="user-rank"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des membres</p>
											<input type="checkbox" name="user-list" value="user-list" id="user-list">
											<label for="user-list"></label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-12">
										<div class="rank__choice">
											<p>Gestion des dédicaces</p>
											<input type="checkbox" name="dedicaces" value="dedicaces" id="dedicaces">
											<label for="dedicaces"></label>
										</div>
										<div class="rank__choice">
											<p>Ajouter un event HC</p>
											<input type="checkbox" name="eventHC-add" value="eventHC-add" id="eventHC-add">
											<label for="eventHC-add"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des events HC</p>
											<input type="checkbox" name="eventHC-list" value="eventHC-list" id="eventHC-list">
											<label for="eventHC-list"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des flux</p>
											<input type="checkbox" name="flux" value="flux" id="flux">
											<label for="flux"></label>
										</div>
										<div class="rank__choice">
											<p>Page à propos</p>
											<input type="checkbox" name="propos" value="propos" id="propos">
											<label for="propos"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des bannis</p>
											<input type="checkbox" name="bannis" value="bannis" id="bannis">
											<label for="bannis"></label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="dashboard__title">
									<i class="fas fa-clipboard-list"></i>
									<h1>Liste des badges</h1>
								</div>
								<div class="rank__badge-content">
									<?php
									$dossier = "../assets/imgs/staffs/";
									if ($handle = opendir($dossier)) {
									while (false !== ($fichier = readdir($handle))) {
									// Obtenez l'extension du fichier
									$extension = pathinfo($fichier, PATHINFO_EXTENSION);

									// Vérifiez si le fichier est une image (vous pouvez ajouter d'autres extensions si nécessaire)
									if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
									?>
									<div class="rank__badge">
										<img src="<?= $dossier; ?><?= $fichier; ?>">
										<p><?= $fichier; ?></p>
									</div>
									<?php } } closedir($handle); } ?>
								</div>
							</div>
						</div>
						<button type="submit" name="submit__rank" class="rank__submit">Rank le membre</button>
					</form>
				</div>
				<?php require('./models/logs-bar.php'); ?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="./assets/js/date.js"></script>
</body>
</html>