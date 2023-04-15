<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'article-add';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 || $verifPage_infos->page_articleAdd == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

function verifDate($date, $format = 'd-m-Y') {
	$dateTime = DateTime::createFromFormat($format, $date);
	if($dateTime === false) {
		return false;
	}
	return $dateTime->format($format) === $date;
}

if(isset($_POST['submit__article'])) {
	if(!empty($_POST['titre']) AND !empty($_POST['description']) AND !empty($_POST['publication']) AND !empty($_POST['contenu'])) {

		$titre 			= htmlspecialchars($_POST['titre']);
		$description 	= htmlspecialchars($_POST['description']);
		$contenu 		= htmlspecialchars($_POST['contenu']);
		$publication 	= htmlspecialchars($_POST['publication']);
		$date 			= date('d-m-Y H:i:s');

		if(strlen($titre) <= 255) {
			if(strlen($description) <= 255) {
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

	                    if(move_uploaded_file($tmpName, '../imagesArticle/'.$file)) {
	                        $insert = $bdd->prepare('INSERT INTO articles(titre, description, image, author, corrector, validator, contenu, date_publication, date_post, etat) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
	                        $insert->execute(array($titre, $description, $file, $session_infos->username, $session_infos->username, $session_infos->username, $contenu, $publication, $date, 1));

	                        $logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
	                        $logs->execute(array($session_infos->id, 'à rédiger un article', $date));
	                        $validate = 'Article publié avec succès !';
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
				$erreur = 'La description ne peut dépasser 255 caractères !';
			}
		} else {
			$erreur = 'Le titre ne peut dépasser 255 caractères !';
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
	<title>Arcade - Créer un article</title>
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
	<!-- TINY -->
	<script src="https://cdn.tiny.cloud/1/3w8jeyzjitn0vwrcamp8byqbl0c8qiirj9rd24gqk9187hvc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<!-- JQUERY -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
					<form method="POST" action="" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-8 col-md-6 col-sm-12">
								<textarea id="article-add" class="article__textarea" rows="15" name="contenu"></textarea>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="article__group">
									<label>Titre</label>
									<input type="text" name="titre" placeholder="Titre" class="article__input">
								</div>
								<div class="article__group">
									<label>Description</label>
									<input type="text" name="description" placeholder="Description" class="article__input">
								</div>
								<div class="article__group">
									<label>Image</label>
									<input type="file" name="image" placeholder="Image" class="article__input">
								</div>
								<div class="article__group">
									<label>Programmé la publication (aaaa-mm-jj hh:mm)</label>
									<input type="text" id="date" name="publication" class="article__input" placeholder="Format: 2023-04-14 19:30">
								</div>
								<button type="submit" name="submit__article" class="article__submit">Publié l'article</button>
							</div>
						</div>
					</form>
				</div>
				<?php require('./models/logs-bar.php'); ?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="./assets/js/date.js"></script>
	<script>
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
  	</script>
</body>
</html>