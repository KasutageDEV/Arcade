<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'event';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_event == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_POST['submit__event'])) {
	if(!empty($_POST['titre']) AND !empty($_POST['author']) AND !empty($_POST['tag']) AND !empty($_POST['link'])) {

		$titre 	= htmlspecialchars($_POST['titre']);
		$author = htmlspecialchars($_POST['author']);
		$tag 	= htmlspecialchars($_POST['tag']);
		$link 	= htmlspecialchars($_POST['link']);
		$date 	= date('d-m-Y H:i:s');

		if(strlen($titre) <= 255) {
			if(isset($_FILES['image'])) {
				$tmpName = $_FILES['image']['tmp_name'];
                $name = $_FILES['image']['name'];
                $size = $_FILES['image']['size'];
                $error1 = $_FILES['image']['error'];

                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                $maxSize = 400000;

                if(in_array($extension, $extensions) && $size <= $maxSize && $error1 == 0){

                    $uniqueName = uniqid('', true);
                    //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                    $file = $uniqueName.".".$extension;
                    //$file = 5f586bf96dcd38.73540086.jpg

                    if(move_uploaded_file($tmpName, '../imagesEvent/'.$file)) {
                        $insert = $bdd->prepare('INSERT INTO event(user_id, author, tag, image, link, date) VALUES(?, ?, ?, ?, ?, ?)');
                        $insert->execute(array($session_infos->id, $author, $tag, $file, $link, $date));

                        $logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
                        $logs->execute(array($session_infos->id, 'à publier un event', $date));

                        $validate = 'Event publié avec succès !';
                    } else {
                        $erreur = 'Une erreur est survenue';
                    }
                } else{
                    $error = "Une erreur est survenue";
                }
			} else {
				$erreur = 'Vous devez upload une image !';
			}
		} else {
			$erreur = 'Le titre ne peut dépasser 255 caractères !';
		}
	} else {
		$erreur = 'Vous devez remplir tous les champs !';
	}
}

if(isset($_POST['submit__delete'])) {

	$id 	= intval($_POST['event_id']);
	$date 	= date('d-m-Y H:i:s');

	$delete = $bdd->prepare('DELETE FROM event WHERE id = ?');
	$delete->execute(array($id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    $logs->execute(array($session_infos->id, 'à supprimer un event', $date));

	$validate = 'Vous avez bien supprimer un event !';
}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Ajouter / Gérer les events hc</title>
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
							<form method="POST" action="" enctype="multipart/form-data">
								<div class="article__group">
									<label>Titre</label>
									<input type="text" name="titre" placeholder="Titre" class="article__input">
								</div>
								<div class="article__group">
									<label>Auteur</label>
									<input type="text" name="author" placeholder="Auteur" class="article__input">
								</div>
								<div class="article__group">
									<label>Tag</label>
									<input type="text" name="tag" placeholder="tag" class="article__input">
								</div>
								<div class="article__group">
									<label>Image</label>
									<input type="file" name="image" placeholder="Image" class="article__input">
								</div>
								<div class="article__group">
									<label>Lien vers l'article HC</label>
									<input type="url" name="link" placeholder="Lien" class="article__input">
								</div>
								<button type="submit" name="submit__event" class="article__submit">Valider</button>
							</form>
						</div>
						<div class="col-lg-8 col-md-6 col-sm-12">
							<div class="article__table">
								<table id="example" style="width:100%">
							        <thead>
							            <tr>
							                <th>Titre</th>
							                <th>Auteur</th>
							                <th>Publié par</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$event = $bdd->query('SELECT * FROM event');
							        	while($event_infos = $event->fetch()) {
							        		$userE = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							        		$userE->execute(array($event_infos->user_id));
							        		$userE_infos = $userE->fetch();
							        	?>
							            <tr>
							                <td><?= $event_infos->titre; ?></td>
							                <td><?= $event_infos->author; ?></td>
							                <td><?= $userE_infos->username; ?></td>
							                <td>
							                	<form method="POST" action="">
							                		<input type="hidden" name="event_id" value="<?= $event_infos->id; ?>">
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