<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'bannis';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_bannis == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_POST['submit__deban'])) {
	$user_id 	= intval($_POST['user_id']);
	$date 		= date('d-m-Y H:i:s');

	$deban = $bdd->prepare('UPDATE users SET is_ban = ? WHERE id = ?');
	$deban->execute(array(0, $user_id));

	$delete = $bdd->prepare('DELETE FROM bans WHERE user_id = ?');
	$delete->execute(array($user_id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    $logs->execute(array($session_infos->id, 'à débannis un membre', $date));

    $validate = 'Vous avez bien débannis un membre';
}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Ajouter / Gérer les bannis</title>
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
					<?php } ?>
					<div class="article__table">
						<table id="example" style="width:100%">
					        <thead>
					            <tr>
					                <th>Pseudo</th>
					                <th>Raison</th>
					                <th>Ban par</th>
					                <th>Date</th>
					                <th></th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php
					        	$bannis = $bdd->prepare('SELECT * FROM users WHERE is_ban = ?');
					        	$bannis->execute(array(1));
					        	while($bannis_infos = $bannis->fetch()) {
					        		$ban = $bdd->prepare('SELECT * FROM bans WHERE user_id = ?');
					        		$ban->execute(array($bannis_infos->id));
					        		$ban_infos = $ban->fetch();
					        	?>
					            <tr>
					                <td><?= $bannis_infos->username; ?></td>
					                <td><?= $ban_infos->reason; ?></td>
					                <td><?= $ban_infos->author; ?></td>
					                <td><?= formater_date($ban_infos->date); ?></td>
					                <td>
					                	<form method="POST" action="">
					                		<input type="hidden" name="user_id" value="<?= $bannis_infos->id; ?>">
				                			<button type="submit" name="submit__deban" class="article__submit red">Débannir</button>
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