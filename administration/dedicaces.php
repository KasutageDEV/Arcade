<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'dedicaces';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_dedicaces == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_POST['submit__refuser'])) {

	$id 	= intval($_POST['dedi_id']);
	$date 	= date('d-m-Y H:i:s');

	$update = $bdd->prepare('UPDATE dedicaces SET etat = ? WHERE id = ?');
	$update->execute(array(3, $id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    $logs->execute(array($session_infos->id, 'à refuser une dédicace', $date));

    $validate = 'Dédicace refuser avec succès';
}

if(isset($_POST['submit__valider'])) {

	$id 	= intval($_POST['dedi_id']);
	$date 	= date('d-m-Y H:i:s');

	$update = $bdd->prepare('UPDATE dedicaces SET etat = ? WHERE id = ?');
	$update->execute(array(2, $id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    $logs->execute(array($session_infos->id, 'à valider une dédicace', $date));

    $validate = 'Dédicace valider avec succès';
}

if(isset($_POST['submit__delete'])) {

	$id 	= intval($_POST['dedi_id']);
	$date 	= date('d-m-Y H:i:s');

	$delete = $bdd->prepare('DELETE FROM dedicaces WHERE id = ?');
	$delete->execute(array($id));

	$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
    $logs->execute(array($session_infos->id, 'à supprimer une dédicace', $date));

    $validate = 'Dédicace supprimer avec succès';
}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arcade - Gestion des dédicaces</title>
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
					<div class="row">
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div class="dashboard__title">
								<i class="fas fa-message"></i>
								<h1>Dédicaces en attente</h1>
							</div>
							<div class="article__table">
								<table id="example" style="width:100%">
							        <thead>
							            <tr>
							                <th>Pseudo</th>
							                <th>Date</th>
							                <th>Message</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$dedicacesV = $bdd->prepare('SELECT * FROM dedicaces WHERE etat = ?');
							        	$dedicacesV->execute(array(1));
							        	while($dedicacesV_infos = $dedicacesV->fetch()) {
							        		$userV = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							        		$userV->execute(array($dedicacesV_infos->user_id));
							        		$userV_infos = $userV->fetch();
							        	?>
							            <tr>
							                <td><?= $userV_infos->username; ?></td>
							                <td><?= formater_date($dedicacesV_infos->date); ?></td>
							                <td><?= $dedicacesV_infos->message; ?></td>
							                <td>
								                <div class="d-flex justify-content-end" style="gap: 10px;">
								                	<form method="POST" action="">
								                		<input type="hidden" name="dedi_id" value="<?= $dedicacesV_infos->id; ?>">
								                		<button type="submit" name="submit__refuser" class="article__submit red">Refuser</button>
								                	</form>
								                	<form method="POST" action="">
								                		<input type="hidden" name="dedi_id" value="<?= $dedicacesV_infos->id; ?>">
								                		<button type="submit" name="submit__valider" class="article__submit">Valider</button>
								                	</form>
								                </div>
							                </td>
							            </tr>
							        	<?php } ?>
							        </tbody>
							    </table>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div class="dashboard__title">
								<i class="fas fa-message"></i>
								<h1>Dédicaces en ligne</h1>
							</div>
							<div class="article__table">
								<table id="example2" style="width:100%">
							        <thead>
							            <tr>
							                <th>Pseudo</th>
							                <th>Date</th>
							                <th>Message</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$dedicaces = $bdd->prepare('SELECT * FROM dedicaces WHERE etat = ?');
							        	$dedicaces->execute(array(2));
							        	while($dedicaces_infos = $dedicaces->fetch()) {
							        		$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
							        		$user->execute(array($dedicaces_infos->user_id));
							        		$user_infos = $user->fetch();
							        	?>
							            <tr>
							                <td><?= $user_infos->username; ?></td>
							                <td><?= formater_date($dedicaces_infos->date); ?></td>
							                <td><?= $dedicaces_infos->message; ?></td>
							                <td>
								                <div class="d-flex justify-content-end" style="gap: 10px;">
								                	<form method="POST" action="">
								                		<input type="hidden" name="dedi_id" value="<?= $dedicaces_infos->id; ?>">
								                		<button type="submit" name="submit__delete" class="article__submit red">Supprimer</button>
								                	</form>
								                </div>
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
		$(document).ready(function () {
		    $('#example2').DataTable();
		});
	</script>
</body>
</html>