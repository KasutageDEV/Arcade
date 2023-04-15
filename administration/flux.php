<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'flux';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_flux == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_GET['update'])) {
	$id = intval($_GET['update']);

	$fluxGET = $bdd->prepare('SELECT * FROM flux WHERE id = ?');
	$fluxGET->execute(array($id));
	$fluxGET_infos = $fluxGET->fetch();
}

if(isset($_POST['submit__flux'])) {
	if(!empty($_POST['username']) AND !empty($_POST['type']) AND !empty($_POST['new_poste']) AND !empty($_POST['badge'])) {

		$username 	= htmlspecialchars($_POST['username']);
		$type 		= intval($_POST['type']);
		$last_poste 	= htmlspecialchars($_POST['last_poste']);
		$new_poste 	= htmlspecialchars($_POST['new_poste']);
		$badge 		= htmlspecialchars($_POST['badge']);
		$date 		= date('d-m-Y H:i:s');

		if(strlen($username) <= 255) {
			if(strlen($last_poste) <= 255) {
				if(strlen($new_poste) <= 255) {
					if($type == '1' || $type == '2' || $type == '3') {
						$insert = $bdd->prepare('INSERT INTO flux(user_id, pseudo, type, last_poste, new_poste, badge, date) VALUES(?, ?, ?, ?, ?, ?, ?)');
						$insert->execute(array($session_infos->id, $username, $type, $last_poste, $new_poste, $badge, $date));

						$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
                        $logs->execute(array($session_infos->id, 'à publier un flux', $date));

                        $validate = 'Flux publié avec succès !';
					} else {
						$erreur = 'Une erreur est survenue !';
					}
				} else {
					$erreur = 'Le nouveau poste ne peut dépasser 255 caractères !';
				}
			} else {
				$erreur = 'L\'ancien poste ne peut dépasser 255 caractères !';
			}
		} else {
			$erreur = 'Le pseudo ne peut dépasser 255 caractères !';
		}
	} else {
		$erreur = 'Vous devez remplir tous les champs !';
	}
}

if(isset($_POST['submit__update'])) {
	if(!empty($_POST['username']) AND !empty($_POST['type']) AND !empty($_POST['new_poste']) AND !empty($_POST['badge'])) {

		$username 	= htmlspecialchars($_POST['username']);
		$type 		= intval($_POST['type']);
		$last_poste 	= htmlspecialchars($_POST['last_poste']);
		$new_poste 	= htmlspecialchars($_POST['new_poste']);
		$badge 		= htmlspecialchars($_POST['badge']);
		$date 		= date('d-m-Y H:i:s');

		if(strlen($username) <= 255) {
			if(strlen($last_poste) <= 255) {
				if(strlen($new_poste) <= 255) {
					if($type == '1' || $type == '2' || $type == '3') {
						$update = $bdd->prepare('UPDATE flux SET pseudo = ?, type = ?, last_poste = ?, new_poste = ?, badge = ? WHERE id = ?');
						$update->execute(array($username, $type, $last_poste, $new_poste, $badge, $fluxGET_infos->id));

						$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
                        $logs->execute(array($session_infos->id, 'à modifier un flux', $date));

                        $validate = 'Flux modifier avec succès !';
					} else {
						$erreur = 'Une erreur est survenue !';
					}
				} else {
					$erreur = 'Le nouveau poste ne peut dépasser 255 caractères !';
				}
			} else {
				$erreur = 'L\'ancien poste ne peut dépasser 255 caractères !';
			}
		} else {
			$erreur = 'Le pseudo ne peut dépasser 255 caractères !';
		}
	} else {
		$erreur = 'Vous devez remplir tous les champs !';
	}
}

if(isset($_POST['submit__delete'])) {

	$id 	= intval($_POST['flux_id']);
	$date 	= date('d-m-Y H:i:s');

	$delete = $bdd->prepare('DELETE FROM flux WHERE id = ?');
	$delete->execute(array($id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    $logs->execute(array($session_infos->id, 'à supprimer un flux', $date));

	$validate = 'Vous avez bien supprimer un flux !';
}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Ajouter / Gérer les flux</title>
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
	<!-- TINY -->
	<script src="https://cdn.tiny.cloud/1/3w8jeyzjitn0vwrcamp8byqbl0c8qiirj9rd24gqk9187hvc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
						<div class="col-lg-4 col-md-6 col-sm-12">
							<form method="POST" action="">
								<div class="article__group">
									<label>Pseudo</label>
									<input type="text" name="username" placeholder="Pseudo" class="article__input">
								</div>
								<div class="article__group">
									<label>Type</label>
									<select name="type" class="article__input">
										<option value="1">Arrivée</option>
										<option value="2">Départ</option>
										<option value="3">Changement de poste</option>
									</select>
								</div>
								<div class="article__group">
									<label>Ancien poste <i>(S'il s'agit d'un changement de poste)</i></label>
									<input type="text" name="last_poste" placeholder="Ancien poste" class="article__input">
								</div>
								<div class="article__group">
									<label>Nouveau poste</label>
									<input type="text" name="new_poste" placeholder="Nouveau poste" class="article__input">
								</div>
								<div class="article__group">
									<label>Badge</label>
									<input type="text" name="badge" placeholder="Code du badge" class="article__input">
								</div>
								<button type="submit" name="submit__flux" class="article__submit">Valider</button>
							</form>
						</div>
						<div class="col-lg-8 col-md-6 col-sm-12">
							<?php if(isset($_GET['update'])) { ?>
							<div class="dashboard__title">
								<i class="fas fa-edit"></i>
								<h1>Modifier un flux</h1>
							</div>
							<form method="POST" action="">
								<div class="row">
									<div class="col-lg-6 col-md-12 col-sm-12">
										<div class="article__group">
											<label>Pseudo</label>
											<input type="text" name="username" value="<?= $fluxGET_infos->pseudo; ?>" class="article__input">
										</div>
										<div class="article__group">
											<label>Type</label>
											<select name="type" class="article__input">
												<option value="1" <?php if($fluxGET_infos->type == 1){ ?>selected<?php } ?>>Arrivée</option>
												<option value="2" <?php if($fluxGET_infos->type == 2){ ?>selected<?php } ?>>Départ</option>
												<option value="3" <?php if($fluxGET_infos->type == 3){ ?>selected<?php } ?>>Changement de poste</option>
											</select>
										</div>
										<div class="article__group">
											<label>Badge</label>
											<input type="text" name="badge" value="<?= $fluxGET_infos->badge; ?>" class="article__input">
										</div>
									</div>
									<div class="col-lg-6 col-md-12 col-sm-12">
										<div class="article__group">
											<label>Ancien poste <i>(S'il s'agit d'un changement de poste)</i></label>
											<input type="text" name="last_poste" value="<?= $fluxGET_infos->last_poste; ?>" class="article__input">
										</div>
										<div class="article__group">
											<label>Nouveau poste</label>
											<input type="text" name="new_poste" value="<?= $fluxGET_infos->new_poste; ?>" class="article__input">
										</div>
									</div>
								</div>
								<button type="submit" name="submit__update" class="article__submit" style="width: 100%;">Valider</button>
							</form>
							<div style="clear: both;"></div>
							<?php } ?>
							<div class="article__table" style="margin-top: 20px;">
								<table id="example" style="width: 100%;">
							        <thead>
							            <tr>
							                <th>Pseudo</th>
							                <th>Type</th>
							                <th>Publié par</th>
							                <th>Date</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$flux = $bdd->query('SELECT * FROM flux');
							        	while($flux_infos = $flux->fetch()) {
							        		$userF = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							        		$userF->execute(array($flux_infos->user_id));
							        		$userF_infos = $userF->fetch();
							        	?>
							            <tr>
							                <td><?= $flux_infos->pseudo; ?></td>
							                <td>
							                	<?php if($flux_infos->type == 1) { ?>
							                		Arrivée
							                	<?php } if($flux_infos->type == 2) { ?>
							                		Départ
							                	<?php } if($flux_infos->type == 3) { ?>
							                		Changement de poste
							                	<?php } ?>
							                </td>
							                <td><?= $userF_infos->username; ?></td>
							                <td><?= formater_date($flux_infos->date); ?></td>
							                <td class="d-flex justify-content-end" style="gap: 10px;">
							                	<a href="?update=<?= $flux_infos->id; ?>" class="article__submit">Edit</a>
							                	<form method="POST" action="">
							                		<input type="hidden" name="flux_id" value="<?= $flux_infos->id; ?>">
						                			<button type="submit" name="submit__delete" class="article__submit red">Supprimer</button>
							                	</form>
							                </td>
							            </tr>
							        	<?php } ?>
							        </tbody>
							    </table>
							</div>
						</div>
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
		tinymce.init({
      		selector: '#article-add',
      		plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      		toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      		tinycomments_mode: 'embedded',
      		tinycomments_author: 'Author name',
      		skin: 'material-classic',
      		mergetags_list: [
        		{ value: 'First.Name', title: 'First Name' },
        		{ value: 'Email', title: 'Email' },
      		]
    	});
    	$( function() {
		    $( "#date" ).datepicker();
		});
	</script>
</body>
</html>