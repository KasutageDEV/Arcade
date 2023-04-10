<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'user-rank';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_userRank == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_POST['submit__rank'])) {
	if(!empty($_POST['username']) AND !empty($_POST['fonction']) AND !empty($_POST['badge']) AND !empty($_POST['categorie'])) {

		// Variables :
		$username 	= htmlspecialchars($_POST['username']);
		$fonction 	= htmlspecialchars($_POST['fonction']);
		$badge 		= htmlspecialchars($_POST['badge']);
		$categorie 	= intval($_POST['categorie']);
		$position 	= intval($_POST['position']);
		$date 		= date('d-m-Y H:i:s');

		// Défaut :
		$page_articleAdd 		= 0;
		$page_articleCorrect 	= 0;
		$page_articleList 		= 0;
		$page_articleValid 		= 0;
		$page_userRank 			= 0;
		$page_userList 			= 0;
		$page_dedicaces			= 0;
		$page_event 			= 0;
		$page_flux	 			= 0;
		$page_apropos 			= 0;
		$page_bannis 			= 0;
		$classement 			= 0;
		$notification 			= 0;

		// Si coché :
		if(isset($_POST['page_articleAdd'])) 		{$page_articleAdd = 1;}
		if(isset($_POST['page_articleCorrect'])) 	{$page_articleCorrect = 1;}
		if(isset($_POST['page_articleList'])) 		{$page_articleList = 1;}
		if(isset($_POST['page_articleValid'])) 		{$page_articleValid = 1;}
		if(isset($_POST['page_userRank'])) 			{$page_userRank = 1;}
		if(isset($_POST['page_userList'])) 			{$page_userList = 1;}
		if(isset($_POST['page_dedicaces'])) 		{$page_dedicaces = 1;}
		if(isset($_POST['page_event'])) 			{$page_event = 1;}
		if(isset($_POST['page_flux'])) 				{$page_flux = 1;}
		if(isset($_POST['page_apropos'])) 			{$page_apropos = 1;}
		if(isset($_POST['page_bannis'])) 			{$page_bannis = 1;}
		if(isset($_POST['classement'])) 			{$classement = 1;}
		if(isset($_POST['notification'])) 			{$notification = 1;}

		// Vérification de l'existance du membre :
		$user = $bdd->prepare('SELECT * FROM users WHERE username = ?');
        $user->execute(array($username));
        $user_infos = $user->fetch();

        $verfistaff = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
        $verfistaff->execute(array($user_infos->id));

        if($user->rowCount() == 1) {
        	if($verfistaff->rowCount() == 0) {
        		if($categorie == '1' || $categorie == '2'  || $categorie == '3'  || $categorie == '4'  || $categorie == '5'  || $categorie == '6'  || $categorie == '7') {

        			$insert = $bdd->prepare('INSERT INTO users_staffs(user_id, fonction, badge, categorie_id, position, page_index, page_articleAdd, page_articleCorrect, page_articleList, page_article_Valid, page_userRank, page_userList, page_dedicaces, page_event, page_flux, page_apropos, page_bannis, classement, notification) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        			$insert->execute(array($user_infos->id, $fonction, $badge, $categorie, $position, 1, $page_articleAdd, $page_articleCorrect, $page_articleList, $page_articleValid, $page_userRank, $page_userList, $page_dedicaces, $page_event, $page_flux, $page_apropos, $page_bannis, $classement, $notification));
        			$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
                    $logs->execute(array($session_infos->id, 'à rank '.$username, $date));
                    $validate = $username.' rank avec succès !';
        		} else {
        			$erreur = 'Une erreur est survenue !';
        		}
        	} else {
        		$erreur = 'Le joueur que vous essayez de rank est déjà staff !';
        	}
        } else {
        	$erreur = 'Le joueur que vous essayez de rank n\'existe pas !';
        }
	} else {
		$erreur = 'Vous devez remplir tous les champs !';
	}
}
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
					<?php if(isset($validate)) { ?>
					<div class="alert success"><?= $validate; ?></div>
					<?php } if(isset($erreur)) { ?>
					<div class="alert danger"><?= $erreur; ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="dashboard__title">
									<i class="fas fa-clipboard-list"></i>
									<h1>Informations général</h1>
								</div>
								<div class="rank__group">
									<label>Pseudo</label>
									<input type="text" name="username" placeholder="Pseudo" class="rank__input">
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
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="dashboard__title">
									<i class="fas fa-clipboard-list"></i>
									<h1>Autorisation des pages</h1>
								</div>
								<div class="row">
									<div class="col-lg-6 col-sm-12">
										<div class="rank__choice">
											<p>Créer un article</p>
											<input type="checkbox" name="page_articleAdd" value="page_articleAdd" id="article-add">
											<label for="article-add"></label>
										</div>
										<div class="rank__choice">
											<p>Corriger un article</p>
											<input type="checkbox" name="page_articleCorrect" value="page_articleCorrect" id="article-correct">
											<label for="article-correct"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des articles</p>
											<input type="checkbox" name="page_articleList" value="page_articleList" id="article-list">
											<label for="article-list"></label>
										</div>
										<div class="rank__choice">
											<p>Valider un article</p>
											<input type="checkbox" name="page_articleValid" value="page_articleValid" id="article-valide">
											<label for="article-valide"></label>
										</div>
										<div class="rank__choice">
											<p>Rank</p>
											<input type="checkbox" name="page_userRank" value="page_userRank" id="user-rank">
											<label for="user-rank"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des membres</p>
											<input type="checkbox" name="page_userList" value="page_userList" id="user-list">
											<label for="user-list"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion du classement</p>
											<input type="checkbox" name="classement" value="classement" id="classement">
											<label for="classement"></label>
										</div>
										<div class="rank__choice">
											<p>Modification de l'information</p>
											<input type="checkbox" name="notification" value="notification" id="notification">
											<label for="notification"></label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-12">
										<div class="rank__choice">
											<p>Gestion des dédicaces</p>
											<input type="checkbox" name="page_dedicaces" value="page_dedicaces" id="dedicaces">
											<label for="dedicaces"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des events HC</p>
											<input type="checkbox" name="page_event" value="page_event" id="eventHC-list">
											<label for="eventHC-list"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des flux</p>
											<input type="checkbox" name="page_flux" value="page_flux" id="flux">
											<label for="flux"></label>
										</div>
										<div class="rank__choice">
											<p>Page à propos</p>
											<input type="checkbox" name="page_apropos" value="page_apropos" id="propos">
											<label for="propos"></label>
										</div>
										<div class="rank__choice">
											<p>Gestion des bannis</p>
											<input type="checkbox" name="page_bannis" value="page_bannis" id="bannis">
											<label for="bannis"></label>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" name="submit__rank" class="rank__submit">Rank le membre</button>
							<!-- <div class="col-lg-4 col-md-6 col-sm-12">
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
							</div> -->
						</div>
					</form>
				</div>
				<?php require('./models/logs-bar.php'); ?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="./assets/js/date.js"></script>
</body>
</html>