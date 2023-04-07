<?php
require('../global.php');
$page = 'article-valid';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 || $verifPage_infos->page_articleValid == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $article = $bdd->prepare('SELECT * FROM articles WHERE id = :id, etat = 1');
    $article->execute(['id' => $id]);
    if($article->rowCount() == 1) {
    } else {
        $article = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 0,1');
    }
} else {
    $article = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 0,1');
}
$article_infos = $article->fetch();

if(isset($_POST['submit__article'])) {
	if(!empty($_POST['titre']) AND !empty($_POST['description']) AND !empty($_POST['contenu'])) {

		$titre 			= htmlspecialchars($_POST['titre']);
		$description 	= htmlspecialchars($_POST['description']);
		$contenu 		= htmlspecialchars($_POST['contenu']);
		$id 			= intval($_POST['article_id']);
		$date 			= date('d-m-Y H:i:s');

		if(strlen($titre)) {
			if(strlen($description)) {
				$correct = $bdd->prepare('UPDATE articles SET titre = ?, description = ?, contenu = ?, validator = ?, etat = ? WHERE id = ?');
				$correct->execute(array($titre, $description, $contenu, $session_infos->username, 3, $id));

				$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
	            $logs->execute(array($session_infos->id, 'à valider un article', $date));
				$validate = 'L\'article à bien été publier';
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
	<title>Arcade - Corriger un article</title>
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
						<div class="col-lg-5 col-md-6 col-sm-12">
							<div class="article__table">
								<table id="example" style="width:100%">
							        <thead>
							            <tr>
							                <th>Titre</th>
							                <th>Auteur</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$articles_a_corriger = $bdd->prepare('SELECT * FROM articles WHERE etat = ?');
							        	$articles_a_corriger->execute(array(2));
							        	while($articles_a_corriger_infos = $articles_a_corriger->fetch()) {
							        	?>
							            <tr>
							                <td><?= $articles_a_corriger_infos->titre; ?></td>
							                <td><?= $articles_a_corriger_infos->author; ?></td>
							                <td><a href="?id=<?= $articles_a_corriger_infos->id; ?>">Corriger</a></td>
							            </tr>
							        	<?php } ?>
							        </tbody>
							    </table>
							</div>
						</div>
						<div class="col-lg-7 col-md-6 col-sm-12">
							<form method="POST" action="">
								<input type="hidden" name="article_id" value="<?= $article_infos->id; ?>">
								<div class="article__group">
									<label>Titre</label>
									<input type="text" name="titre" placeholder="Titre" class="article__input" value="<?= $article_infos->titre; ?>">
								</div>
								<div class="article__group">
									<label>Description</label>
									<input type="text" name="description" placeholder="Description" class="article__input" value="<?= $article_infos->description; ?>">
								</div>
								<textarea id="article-add" class="article__textarea" rows="15" name="contenu"><?= $article_infos->contenu; ?></textarea>
								<button type="submit" name="submit__article" class="article__submit" style="margin-top:20px;">Valider</button>
							</form>
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
	</script>
</body>
</html>