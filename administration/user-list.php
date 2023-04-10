<?php
require('../global.php');
require('../php/functions/Date.php');
$page = 'user-list';

if(!isset($_SESSION['id'])) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

$verifPage = $bdd->prepare('SELECT * FROM users_staffs WHERE user_id = ?');
$verifPage->execute(array($session_infos->id));
$verifPage_infos = $verifPage->fetch();

if($verifPage->rowCount() == 0 OR $verifPage_infos->page_userList == 0) {
	header('Location: '.$website_infos->link.'/index');
	exit();
}

if(isset($_POST['submit__ban'])) {
	$id = intval($_POST['user_id']);

	$addBan = $bdd->prepare('INSERT INTO bans(user_id, reason, author, date) VALUES(?, ?, ?, ?)');
	$addBan->execute(array($id, $re));
}

if(isset($_GET['user'])) {
	$username = htmlspecialchars($_GET['user']);

	$userGET = $bdd->prepare('SELECT * FROM users WHERE username = ?');
	$userGET->execute(array($username));
	$userGET_infos = $userGET->fetch();
}

if(isset($_POST['submit__ban'])) {
	if(!empty($_POST['username']) AND !empty($_POST['reason'])) {
		$username 	= htmlspecialchars($_POST['username']);
		$reason 	= htmlspecialchars($_POST['reason']);
		$date 		= date('d-m-Y H:i:s');

		$update = $bdd->prepare('UPDATE users SET is_ban = ? WHERE username = ?');
		$update->execute(array(1, $username));

		$insert = $bdd->prepare('INSERT INTO bans(user_id, reason, author, date) VALUES(?, ?, ?, ?)');
		$insert->execute(array($userGET_infos->id, $reason, $session_infos->username, $date));

		$logs = $bdd->prepare('INSERT INTO logs(user_id, logs, date) VALUES(?, ?, ?)');
        $logs->execute(array($session_infos->id, 'à bannis '.$username, $date));

        $validate = 'Vous avez bien bannis '.$username;
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
	<title>Arcade - Gestion des membres</title>
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
						<div class="<?php if(isset($_GET['user'])) { ?>col-lg-9<?php } else { ?>col-lg-12<?php } ?> col-md-12 col-sm-12">
							<div class="article__table">
								<table id="example" style="width:100%">
							        <thead>
							            <tr>
							                <th>Pseudo</th>
							                <th>E-mail</th>
							                <th>Date d'inscription</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$user = $bdd->query('SELECT * FROM users');
							        	while($user_infos = $user->fetch()) {
							        	?>
							            <tr>
							                <td><?= $user_infos->username; ?></td>
							                <td><?= $user_infos->email; ?></td>
							                <td><?= formater_date($user_infos->date_register); ?></td>
							                <td>
							                	<a href="?user=<?= $user_infos->username; ?>" class="article__submit red">Bannir <?= $user_infos->username; ?></a>
							                </td>
							            </tr>
							        	<?php } ?>
							        </tbody>
							    </table>
							</div>
						</div>
						<?php if(isset($_GET['user'])) { ?>
						<div class="col-lg-3 col-md-6 col-sm-12">
							<?php if(isset($validate)) { ?>
							<div class="alert success"><?= $validate; ?></div>
							<?php } if(isset($erreur)) { ?>
							<div class="alert danger"><?= $erreur; ?></div>
							<?php } ?>
							<form method="POST" action="">
								<div class="article__group">
									<label>Pseudo</label>
									<input type="text" name="username" value="<?= $userGET_infos->username; ?>" class="article__input" disabled>
								</div>
								<div class="article__group">
									<label>Raison du ban</label>
									<input type="text" name="reason" placeholder="Raison" class="article__input">
								</div>
								<button type="submit" name="submit__ban" class="article__submit red">Bannir</button>
							</form>
						</div>
						<?php } ?>
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