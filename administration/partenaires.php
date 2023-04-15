<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'partenaires';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_partenaires == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_POST['submit__categorie'])) {
	if(!empty($_POST['nom'])) {

		$nom = htmlspecialchars($_POST['nom']);
		$date = date('d-m-Y H:i:s');

		if(strlen($nom) <= 255) {
			if(isset($_FILES['icon'])){
				$tmpName = $_FILES['icon']['tmp_name'];
                $name = $_FILES['icon']['name'];
                $size = $_FILES['icon']['size'];
                $error1 = $_FILES['icon']['error'];

                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                $maxSize = 400000;

                if(in_array($extension, $extensions) && $size <= $maxSize && $error1 == 0){

                    $uniqueName = uniqid();
                    //uniqid génère quelque chose comme ca : 5f586bf96dcd38
                    $file = $uniqueName.".".$extension;
                    //$file = 5f586bf96dcd38.jpg

                    if(move_uploaded_file($tmpName, '../imagesPartenaire/'.$file)) {
                     
						$add = $bdd->prepare('INSERT INTO partenaires_categories(name, icon, creator) VALUES(?, ?, ?)');
						$add->execute(array($nom, $file, $session_infos->username));

						$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
				    	$logs->execute(array($session_infos->id, 'à ajouter une catégorie partenaire', $date));

				    	$validate = 'Vous avez bien ajouter une catégorie !';
        
                    } else {
                        $erreur = 'Une erreur est survenue';
                    }
                } else{
                    $erreur = "Une erreur est survenue !";
                }
			} else {
				$erreur = 'L\'icon n\'a pas pas été upload !';
			}
		} else {
			$erreur = 'Le nom de la catégorie est trop long !';
		}
	} else {
		$erreur = 'Vous devez remplir tous les champs !';
	}
}

if(isset($_POST['submit__delete'])) {

	$categorie_id 	= intval($_POST['categorie_id']);
	$date 			= date('d-m-Y H:i:s');

	$delete = $bdd->prepare('DELETE FROM partenaires_categories WHERE id = ?');
	$delete->execute(array($categorie_id));

	$staffs = $bdd->prepare('DELETE FROM partenaires_staffs WHERE categorie_id = ?');
	$staffs->execute(array($categorie_id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
	$logs->execute(array($session_infos->id, 'à supprimer une catégorie partenaire', $date));

	$validate = 'Vous avez bien supprimer une catégorie ainsi que les staffs associé à celle-ci !';
}

if(isset($_POST['submit__user'])) {
	if(!empty($_POST['username']) AND !empty($_POST['fonction']) AND !empty($_POST['position']) AND !empty($_POST['categorie'])) {

		$username 	= htmlspecialchars($_POST['username']);
		$fonction 	= htmlspecialchars($_POST['fonction']);
		$position 	= intval($_POST['position']);
		$categorie 	= intval($_POST['categorie']);
		$date 		= date('d-m-Y H:i:s');

		// Vérification de l'existance du membre :
		$user = $bdd->prepare('SELECT * FROM users WHERE username = ?');
        $user->execute(array($username));
        $user_infos = $user->fetch();

        $verif_cat = $bdd->query('SELECT * FROM partenaires_categories');
        $count_verif_cat = $verif_cat->rowCount();

        if($user->rowCount() == 1) {
        	if($categorie !== '0') {
	        	if($count_verif_cat >= 1) {
	        		$insert = $bdd->prepare('INSERT INTO partenaires_staffs(user_id, categorie_id, fonction, position) VALUES(?, ?, ?, ?)');
	        		$insert->execute(array($user_infos->id, $categorie, $fonction, $position));

	        		$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
					$logs->execute(array($session_infos->id, 'à ajouter un partenaire', $date));

					$validate = 'Vous avez bien ajouter un partenaire !';
	        	} else {
	        		$erreur = 'Aucune catégorie en créer, créez-en une avant d\'ajouter un partenaire !';
	        	}
        	} else {
        		$erreur = 'Une erreur est survenue !';
        	}
        } else {
        	$erreur = 'Le joueur que vous avez essayer de rank n\'existe pas !';
        }
	} else {
		$erreur = 'Vous devez remplir tous les champs !';
	}
}

if(isset($_POST['submit__derank'])) {
	$user_id 	= intval($_POST['user_id']);
	$date 		= date('d-m-Y H:i:s');

	$derank = $bdd->prepare('DELETE FROM partenaires_staffs WHERE user_id = ?');
	$derank->execute(array($user_id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
	$logs->execute(array($session_infos->id, 'à derank un partenaire', $date));

	$validate = 'Vous avez bien derank un partenaire !';
}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Admin</title>
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
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="dashboard__title">
								<i class="fas fa-clipboard-list"></i>
								<h1>Catégorie</h1>
							</div>
							<form method="POST" action="" enctype="multipart/form-data">
								<div class="article__group">
									<label>Nom de la catégorie</label>
									<input type="text" name="nom" placeholder="Nom de la catégorie" class="article__input">
								</div>
								<div class="article__group">
									<label>Icon de la catégorie</label>
									<input type="file" name="icon" placeholder="Icon de la catégorie" class="article__input">
								</div>
								<button type="submit" name="submit__categorie" class="article__submit">Ajouter</button>
							</form>
							<div  style="clear: both;"></div>
							<div class="article__table" style="margin-top: 20px;">
								<table id="example1" style="width:100%;">
							        <thead>
							            <tr>
							                <th>Catégorie</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$categories = $bdd->query('SELECT * FROM partenaires_categories');
							        	while($categories_infos = $categories->fetch()) {
							        	?>
							            <tr>
							                <td><?= $categories_infos->name; ?></td>
							                <td>
							                	<form method="POST" action="">
							                		<input type="hidden" name="categorie_id" value="<?= $categories_infos->id; ?>">
							                		<button type="submit" name="submit__delete" class="article__submit red">Supprimer</button>
							                	</form>
							                </td>
							            </tr>
							        	<?php } ?>
							        </tbody>
							    </table>
							</div>
						</div>

						<div class="col-lg-8 col-md-6 col-sm-12">
							<div class="dashboard__title">
								<i class="fas fa-plus"></i>
								<h1>Ajouter un membre</h1>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-12 col-sm-12">
									<form method="POST" action="">
										<div class="article__group">
											<label>Pseudo</label>
											<input type="text" name="username" placeholder="Pseudo" class="article__input">
										</div>
										<div class="article__group">
											<label>Fonction</label>
											<input type="text" name="fonction" placeholder="Fonction" class="article__input">
										</div>
										<div class="article__group">
											<label>Position</label>
											<input type="number" name="position" placeholder="Position" class="article__input">
										</div>
										<div class="article__group">
											<label>Catégorie</label>
											<select name="categorie" class="article__input">
												<option value="0">Choisissez une catégorie !</option>
												<?php
												$categoriesSELECT = $bdd->query('SELECT * FROM partenaires_categories');
												while($categoriesSELECT_infos = $categoriesSELECT->fetch()) {
												?>
												<option value="<?= $categoriesSELECT_infos->id; ?>"><?= $categoriesSELECT_infos->name; ?></option>
												<?php } ?>
											</select>
										</div>
										<button type="submit" name="submit__user" class="article__submit">Publier</button>
									</form>
									<div  style="clear: both;"></div>
								</div>
								<div class="col-lg-6 col-md-12 col-sm-12">
									<div class="article__table" style="margin-top: 20px;">
										<table id="example2" style="width:100%;">
									        <thead>
									            <tr>
									                <th>Membre</th>
									                <th>Orga</th>
									                <th></th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php
									        	$staff = $bdd->query('SELECT * FROM partenaires_staffs');
									        	while($staff_infos = $staff->fetch()) {
									        		$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
											        $user->execute(array($staff_infos->user_id));
											        $user_infos = $user->fetch();

											        $cat = $bdd->prepare('SELECT * FROM partenaires_categories WHERE id = ?');
											        $cat->execute(array($staff_infos->categorie_id));
											        $cat_infos = $cat->fetch();
									        	?>
									            <tr>
									            	<td><?= $user_infos->username; ?></td>
									                <td><?= $cat_infos->name; ?></td>
									                <td>
									                	<form method="POST" action="">
									                		<input type="hidden" name="user_id" value="<?= $staff_infos->user_id; ?>">
									                		<button type="submit" name="submit__derank" class="article__submit red">Dérank</button>
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
					</div>
				</div>
				<?php require('./models/logs-bar.php'); ?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="./assets/js/date.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
		    $('#example1').DataTable();
		});
		$(document).ready(function () {
		    $('#example2').DataTable();
		});
	</script>
</body>
</html>