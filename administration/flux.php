<?php
$page = 'flux';
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
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12">
							<form method="POST" action="">
								<div class="article__group" style="margin-top: 20px;">
									<label>Pseudo</label>
									<input type="text" name="titre" placeholder="Titre" class="article__input">
								</div>
								<div class="article__group">
									<label>Auteur</label>
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
									<label>Nouveau post</label>
									<input type="text" name="new_poste" placeholder="Nouveau poste" class="article__input">
								</div>
								<div class="article__group">
									<label>Badge</label>
									<input type="text" name="badge" placeholder="Code du badge" class="article__input">
								</div>
								<button type="submit" name="submit__article" class="article__submit">Valider</button>
							</form>
						</div>
						<div class="col-lg-8 col-md-6 col-sm-12">
							<div class="article__table">
								<table id="example" style="width:100%">
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
							            <tr>
							                <td>Kaana</td>
							                <td>Arrivée</td>
							                <td>Anubis</td>
							                <td>04/04/2023 à 11:34</td>
							                <td>
							                	<form method="POST" action="">
							                		<input type="hidden" name="event_id" value="0">
						                			<button type="submit" class="article__submit red">Supprimer</button>
							                	</form>
							                </td>
							            </tr>
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