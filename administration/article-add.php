<?php
$page = 'article-add';
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
					<form method="POST" action="">
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
									<input type="text" name="image" placeholder="Image" class="article__input">
								</div>
								<div class="article__group">
									<label>Programmé la publication</label>
									<input type="date" id="date" name="publication" class="article__input">
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
    	$( function() {
		    $( "#date" ).datepicker();
		});
  	</script>
</body>
</html>