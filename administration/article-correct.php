<?php
$page = 'article-correct';
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
							            <tr>
							                <td>Titre de l'article</td>
							                <td>Kasutage</td>
							                <td><a href="#">Modifier</a></td>
							            </tr>
							        </tbody>
							    </table>
							</div>
						</div>
						<div class="col-lg-7 col-md-6 col-sm-12">
							<form method="POST" action="">
								<textarea id="article-add" class="article__textarea" rows="15" name="contenu"></textarea>
								<div class="article__group" style="margin-top: 20px;">
									<label>Titre</label>
									<input type="text" name="titre" placeholder="Titre" class="article__input">
								</div>
								<div class="article__group">
									<label>Description</label>
									<input type="text" name="description" placeholder="Description" class="article__input">
								</div>
								<div class="article__group">
									<label>Image</label>
									<input type="text" name="image" placeholder="Image" class="article__input">
								</div>
								<div class="article__group">
									<label>Programmé la publication</label>
									<input type="date" id="date" name="publication" class="article__input">
								</div>
								<button type="submit" name="submit__article" class="article__submit">Valider</button>
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
    	$( function() {
		    $( "#date" ).datepicker();
		});
	</script>
</body>
</html>