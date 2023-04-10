<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'article-list';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_articleList == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_POST['submit__article'])) {
	$id 	= intval($_POST['article_id']);
	$date 	= date('d-m-Y H:i:s');

	$delete = $bdd->prepare('DELETE FROM articles WHERE id = ?');
	$delete->execute(array($id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
	$logs->execute(array($session_infos->id, 'à supprimer un article', $date));
	$validate = 'L\'article à bien été supprimer';
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
					<?php } ?>
					<div class="article__table">
						<table id="example" style="width:100%">
					        <thead>
					            <tr>
					                <th>Titre</th>
					                <th>Auteur</th>
					                <th>Correcteur</th>
					                <th>Valider par</th>
					                <th>État</th>
					                <th>Date</th>
					                <th></th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php
					        	$article = $bdd->query('SELECT * FROM articles');
					        	while($article_infos = $article->fetch()) {
					        	?>
					            <tr>
					                <td><?= $article_infos->titre; ?></td>
					                <td><?= $article_infos->author; ?></td>
					                <td><?= $article_infos->corrector; ?></td>
					                <td><?= $article_infos->validator; ?></td>
					                <td>
					                	<?php if($article_infos->etat == 1) { ?>
					                		<span class="badge warning">En attente de correction</span>
					                	<?php } if($article_infos->etat == 2) { ?>
					                		<span class="badge danger">En attente de validation</span>
					                	<?php } if($article_infos->etat == 3) { ?>
					                		<span class="badge success">En ligne</span>
					                	<?php } ?>
					                </td>
					                <td><?= formater_date($article_infos->date_post); ?></td>
					                <td>
					                	<form method="POST" action="">
					                		<input type="hidden" name="article_id" value="<?= $article_infos->id; ?>">
					                		<button type="submit" name="submit__article" class="article__submit red">Supprimer</button>
					                	</form>
					                </td>
					            </tr>
					        	<?php } ?>
					        </tbody>
					    </table>
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