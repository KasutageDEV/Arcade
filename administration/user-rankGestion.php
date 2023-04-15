<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'user-rankGestion';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_userRankGestion == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_GET['user'])) {
	$username = htmlspecialchars($_GET['user']);

	$userGET = $bdd->prepare('SELECT * FROM users WHERE username = ?');
	$userGET->execute(array($username));
	$userGET_infos = $userGET->fetch();

	$staff = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
	$staff->execute(array($userGET_infos->id));
	$staff_infos = $staff->fetch();
}

if(isset($_POST['submit__modif'])) {
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
		$page_userRankGestion 	= 0;
		$page_userList 			= 0;
		$page_partenaires 		= 0;
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
		if(isset($_POST['page_userRankGestion'])) 	{$page_userRankGestion = 1;}
		if(isset($_POST['page_userList'])) 			{$page_userList = 1;}
		if(isset($_POST['page_partenaires'])) 		{$page_partenaires = 1;}
		if(isset($_POST['page_dedicaces'])) 		{$page_dedicaces = 1;}
		if(isset($_POST['page_event'])) 			{$page_event = 1;}
		if(isset($_POST['page_flux'])) 				{$page_flux = 1;}
		if(isset($_POST['page_apropos'])) 			{$page_apropos = 1;}
		if(isset($_POST['page_bannis'])) 			{$page_bannis = 1;}
		if(isset($_POST['classement'])) 			{$classement = 1;}
		if(isset($_POST['notification'])) 			{$notification = 1;}

		if($categorie == '1' || $categorie == '2'  || $categorie == '3'  || $categorie == '4'  || $categorie == '5'  || $categorie == '6'  || $categorie == '7') {

			$insert = $bdd->prepare('UPDATE users_staffs SET fonction = ?, badge = ?, categorie_id = ?, position = ?, page_articleAdd = ?, page_articleCorrect = ?, page_articleList = ?, page_articleValid = ?, page_userRank = ?, page_userRankGestion = ?, page_userList = ?, page_partenaires = ?, page_dedicaces = ?, page_event = ?, page_flux = ?, page_apropos = ?, page_bannis = ?, classement = ?, notification = ? WHERE user_id = ?');
			$insert->execute(array($fonction, $badge, $categorie, $position, $page_articleAdd, $page_articleCorrect, $page_articleList, $page_articleValid, $page_userRank, $page_userRankGestion, $page_userList, $page_partenaires, $page_dedicaces, $page_event, $page_flux, $page_apropos, $page_bannis, $classement, $notification, $staff_infos->user_id));

			$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
            $logs->execute(array($session_infos->id, 'à modifier le rank de '.$username, $date));

            $validate = $username.' à modifier le rank avec succès !';
		} else {
			$erreur = 'Une erreur est survenue !';
    	}
	} else {
		$erreur = 'Vous devez remplir tous les champs !';
	}
}

if(isset($_POST['submit__derank'])) {
	$id 	= intval($_POST['user_id']);
	$date 	= date('d-m-Y H:i:s');

	$derank = $bdd->prepare('DELETE FROM users_staffs WHERE user_id = ?');
	$derank->execute(array($user_id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    $logs->execute(array($session_infos->id, 'à dérank un staff', $date));

    $validate = 'Vous avez bien dérank avec succès !';
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
	<!-- JQUERY -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  	<!-- DATATABLE -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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
					<div class="row">
						<div class="<?php if(isset($_GET['user'])) { ?>col-lg-4<?php } else { ?>col-lg-12<?php } ?> col-md-6 col-sm-12">
							<div class="article__table">
								<table id="example" style="width:100%">
							        <thead>
							            <tr>
							                <th>Pseudo</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$list = $bdd->query('SELECT * FROM users_staffs');
							        	while($list_infos = $list->fetch()) {
							        		$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							        		$user->execute(array($list_infos->user_id));
							        		$user_infos = $user->fetch();
							        	?>
							            <tr>
							                <td><?= $user_infos->username; ?> <i><?= $list_infos->fonction; ?></i></td>
							                <td class="d-flex justify-content-end" style="gap: 10px;">
							                	<a href="?user=<?= $user_infos->username; ?>" class="article__submit">Modifier</a>
							                	<form method="POST" action="">
							                		<input type="hidden" name="user_id" value="<?= $list_infos->user_id; ?>">
							                		<button type="submit" name="submit__derank" class="article__submit red">Dérank</button>
							                	</form>
							                </td>
							            </tr>
							        	<?php } ?>
							        </tbody>
							    </table>
							</div>
						</div>
						<?php if(isset($_GET['user'])) { ?>
						<div class="col-lg-8 col-md-6 col-sm-12">
							<form method="POST" action="">
								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="rank__group">
											<label>Pseudo</label>
											<input type="text" name="username" value="<?= $userGET_infos->username; ?>" class="rank__input">
										</div>
										<div class="rank__group">
											<label>Fonction</label>
											<input type="text" name="fonction" value="<?= $staff_infos->fonction; ?>" class="rank__input">
										</div>
										<div class="rank__group">
											<label>Badge</label>
											<input type="text" name="badge" value="<?= $staff_infos->badge; ?>" class="rank__input">
										</div>
										<div class="rank__group">
											<label>Catégorie</label>
											<select name="categorie" class="rank__input">
												<option value="1" <?php if($staff_infos->categorie_id == 1){ ?>selected<?php } ?>>Gestion</option>
												<option value="2" <?php if($staff_infos->categorie_id == 2){ ?>selected<?php } ?>>Administrateur</option>
												<option value="3" <?php if($staff_infos->categorie_id == 3){ ?>selected<?php } ?>>Édition</option>
												<option value="4" <?php if($staff_infos->categorie_id == 4){ ?>selected<?php } ?>>Animation</option>
												<option value="5" <?php if($staff_infos->categorie_id == 5){ ?>selected<?php } ?>>Évènementiel</option>
												<option value="6" <?php if($staff_infos->categorie_id == 6){ ?>selected<?php } ?>>Communication</option>
												<option value="7" <?php if($staff_infos->categorie_id == 7){ ?>selected<?php } ?>>Création</option>
											</select>
										</div>
										<div class="rank__group">
											<label>Position</label>
											<input type="number" name="position" value="<?= $staff_infos->position; ?>" class="rank__input">
										</div>
									</div>
									<div class="col-lg-8 col-md-6 col-sm-12">
										<div class="row">
											<div class="col-lg-6 col-sm-12">
												<div class="rank__choice">
													<p>Créer un article</p>
													<input type="checkbox" name="page_articleAdd" value="page_articleAdd" id="article-add" <?php if($staff_infos->page_articleAdd == 1){ ?>checked<?php } ?>>
													<label for="article-add"></label>
												</div>
												<div class="rank__choice">
													<p>Corriger un article</p>
													<input type="checkbox" name="page_articleCorrect" value="page_articleCorrect" id="article-correct" <?php if($staff_infos->page_articleCorrect == 1){ ?>checked<?php } ?>>
													<label for="article-correct"></label>
												</div>
												<div class="rank__choice">
													<p>Gestion des articles</p>
													<input type="checkbox" name="page_articleList" value="page_articleList" id="article-list" <?php if($staff_infos->page_articleList == 1){ ?>checked<?php } ?>>
													<label for="article-list"></label>
												</div>
												<div class="rank__choice">
													<p>Valider un article</p>
													<input type="checkbox" name="page_articleValid" value="page_articleValid" id="article-valide" <?php if($staff_infos->page_articleValid == 1){ ?>checked<?php } ?>>
													<label for="article-valide"></label>
												</div>
												<div class="rank__choice">
													<p>Rank</p>
													<input type="checkbox" name="page_userRank" value="page_userRank" id="user-rank"<?php if($staff_infos->page_userRank == 1){ ?>checked<?php } ?>>
													<label for="user-rank"></label>
												</div>
												<div class="rank__choice">
													<p>Gestion des rank</p>
													<input type="checkbox" name="page_userRankGestion" value="page_userRankGestion" id="user-rankGestion" <?php if($staff_infos->page_userRankGestion == 1){ ?>checked<?php } ?>>
													<label for="user-rankGestion"></label>
												</div>
												<div class="rank__choice">
													<p>Gestion des membres</p>
													<input type="checkbox" name="page_userList" value="page_userList" id="user-list" <?php if($staff_infos->page_userList == 1){ ?>checked<?php } ?>>
													<label for="user-list"></label>
												</div>
												<div class="rank__choice">
													<p>Gestion des partenaires</p>
													<input type="checkbox" name="page_partenaires" value="page_partenaires" id="partenaires" <?php if($staff_infos->page_partenaires == 1){ ?>checked<?php } ?>>
													<label for="partenaires"></label>
												</div>
												<div class="rank__choice">
													<p>Gestion du classement</p>
													<input type="checkbox" name="classement" value="classement" id="classement" <?php if($staff_infos->classement == 1){ ?>checked<?php } ?>>
													<label for="classement"></label>
												</div>
												<div class="rank__choice">
													<p>Modification de l'information</p>
													<input type="checkbox" name="notification" value="notification" id="notification" <?php if($staff_infos->notification == 1){ ?>checked<?php } ?>>
													<label for="notification"></label>
												</div>
											</div>
											<div class="col-lg-6 col-sm-12">
												<div class="rank__choice">
													<p>Gestion des dédicaces</p>
													<input type="checkbox" name="page_dedicaces" value="page_dedicaces" id="dedicaces" <?php if($staff_infos->page_dedicaces == 1){ ?>checked<?php } ?>>
													<label for="dedicaces"></label>
												</div>
												<div class="rank__choice">
													<p>Gestion des events HC</p>
													<input type="checkbox" name="page_event" value="page_event" id="eventHC-list" <?php if($staff_infos->page_event == 1){ ?>checked<?php } ?>>
													<label for="eventHC-list"></label>
												</div>
												<div class="rank__choice">
													<p>Gestion des flux</p>
													<input type="checkbox" name="page_flux" value="page_flux" id="flux" <?php if($staff_infos->page_flux == 1){ ?>checked<?php } ?>>
													<label for="flux"></label>
												</div>
												<div class="rank__choice">
													<p>Page à propos</p>
													<input type="checkbox" name="page_apropos" value="page_apropos" id="propos" <?php if($staff_infos->page_apropos == 1){ ?>checked<?php } ?>>
													<label for="propos"></label>
												</div>
												<div class="rank__choice">
													<p>Gestion des bannis</p>
													<input type="checkbox" name="page_bannis" value="page_bannis" id="bannis" <?php if($staff_infos->page_bannis == 1){ ?>checked<?php } ?>>
													<label for="bannis"></label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<button type="submit" name="submit__modif" class="article__submit" style="width: 100%;">Mettre à jour</button>
							</form>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php require('./models/logs-bar.php'); ?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="./assets/js/date.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
		    $('#example').DataTable();
		});
	</script>
</body>
</html>