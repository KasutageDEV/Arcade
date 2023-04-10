	<?php require('./php/functions/headerText.php'); ?>
	<?php require('./php/functions/headerTitle.php'); ?>
	<section class="main">
		<header class="header">
			<div class="header__left">
				<img src="./assets/imgs/logo1.png" class="header__logo">
				<?php if(isset($_SESSION['id'])) { ?>
					<div class="header__user">
						<div class="header__avatar">
							<img src="https://api.habbocity.me/avatar_image.php?user=<?= $session_infos->username; ?>&headonly=0&direction=2&head_direction=2&size=n&headonly=1">
						</div>
						<div class="header__infos">
							<p><?= $session_infos->username; ?></p>
							<p><?= $motto; ?></p>
						</div>
					</div>
				<?php } ?>
			</div>
			<ul class="nav" id="nav">
				<li><a href="./index">Accueil</a></li>
				<li class="dropdown">
					<a href="javascript:void(0);">Communauté</a>
					<ul class="submenu">
						<li><a href="./articles">Article</a></li>
						<li><a href="./staffs">Équipe</a></li>
						<li><a href="./flux">Flux</a></li>
						<li><a href="./dedicace">Dédicaces</a></li>
					</ul>
				</li>
				<li><a href="./classement">Classement</a></li>
				<li><a href="./about">À propos</a></li>
				<?php if(!isset($_SESSION['id'])) { ?>
					<li><a href="javascript:void(0);" id="openLoginModal" class="nav__btn">Se connecter</a></li>
					<li><a href="javascript:void(0);" id="openRegisterModal" class="nav__btn register">S'inscrire</a></li>
				<?php } else { ?>
					<li><a href="./administration/index" id="openRegisterModal" class="nav__btn admin">Administration</a></li>
					<li><a href="./account/logout" id="openRegisterModal" class="nav__btn logout">Déconnexion</a></li>
				<?php } ?>
			</ul>
			<button id="hamburger-btn" class="hamburger-btn">
			  	<span class="hamburger-line"></span>
			  	<span class="hamburger-line"></span>
			  	<span class="hamburger-line"></span>
			</button>
		</header>
		<div class="main__content">
			<div class="main__infos">
				<div class="main__title">
					<?= headerTitle($page); ?>
				</div>
				<?= headerText($page); ?>
			</div>
			<div class="main__count">
				<span>50</span> HabboCity's en ligne !
			</div>
		</div>
	</section>

	<div class="container">
		<div class="dedicaces">
			<div class="dedicaces__head">
				<p>Dédicaces :</p>
				<img src="./assets/imgs/dedicace.svg">
			</div>
			<marquee>
				<?php
				$dedi = $bdd->prepare('SELECT * FROM dedicaces WHERE etat = ?');
				$dedi->execute(array(2));
				while($dedi_infos = $dedi->fetch()) {
					$user = $bdd->prepare('SELECT * FROM users WHERE id = ?');
					$user->execute(array($dedi_infos->user_id));
					$user_infos = $user->fetch();
				?>
				<span><b><?= $user_infos->username; ?> :</b> <?= $dedi_infos->message; ?></span>
				<?php } ?>
			</marquee>
		</div>
	</div>

	<!-- ModalLogin -->
	<div class="modal" id="modalLogin">
		<div class="modal__content">
			<button type="button" class="modal__close" id="closeLoginModal"><i class="fas fa-times"></i></button>
			<h1>Connexion à Arcade</h1>
			<form method="POST" action="">
				<div class="modal__formgroup">
					<label>Pseudo</label>
					<input type="text" name="l_username" id="l_username" placeholder="Pseudonyme">
				</div>
				<div class="modal__formgroup">
					<label>Mot de passe</label>
					<input type="password" name="l_password" id="l_password" placeholder="Mot de passe">
				</div>
				<button type="submit" id="formLogin" class="modal__submit login">Connexion</button>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#formLogin").on('click', function(event){
			event.preventDefault();
			$.ajax({
				type: "POST",
				url: "<?= $website_infos->link; ?>/php/req/login.php",
				data: "l_username="+$("#l_username").val()+"&l_password="+$("#l_password").val(),
				success: function(msg){
					if(msg == "ok") {
						Swal.fire({
						  position: 'bottom-end',
						  icon: 'success',
						  title: 'Coucou !',
						  text: 'Heureux de vous revoir '+$("#l_username").val(),
						  showConfirmButton: false,
						  toast: true,
						  timer: 2000
						});
					}else {
						Swal.fire({
						  position: 'bottom-end',
						  icon: 'error',
						  title: 'Oops !',
						  text: msg,
						  showConfirmButton: false,
						  toast: true,
						  timer: 2000
						});
					}

					setTimeout(function() {
						document.location.reload();
					}, 3000);
				}
			});
		});
	});
	</script>

	<?php
	$captcha = "AI-".mt_rand(1000, 9999);
	?>
	<!-- ModalRegister -->
	<div class="modal" id="modalRegister">
		<div class="modal__content">
			<button type="button" class="modal__close" id="closeRegisterModal"><i class="fas fa-times"></i></button>
			<h1>Inscription à Arcade</h1>
			<form method="POST" action="">
				<input type="hidden" name="captcha" id="captcha" value="<?= $captcha; ?>">
				<div class="modal__formgroup">
					<label>Votre pseudo HabboCity</label>
					<input type="text" name="username" id="username" placeholder="Pseudonyme">
				</div>
				<div class="modal__formgroup">
					<label>E-mail</label>
					<input type="email" name="email" id="email" placeholder="E-mail">
				</div>
				<div class="modal__formgroup">
					<label>Mot de passe</label>
					<input type="password" name="password" id="password" placeholder="Mot de passe">
				</div>
				<div class="modal__formgroup">
					<label>Vérification du mot de passe</label>
					<input type="password" name="repassword" id="repassword" placeholder="Encore une fois">
				</div>
				<p>Avant de validé votre inscription veuillez entré ce code dans votre mission sur <b>HabboCity</b> afin de vérifier que le compte vous appartient :</p>
				<h3><?= $captcha; ?></h3>
				<button type="submit" id="formRegister" name="submit__register" class="modal__submit register">Inscription</button>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#formRegister").on('click', function(event){
			event.preventDefault();
			$.ajax({
				type: "POST",
				url: "<?= $website_infos->link; ?>/php/req/register.php",
				data: "username="+$("#username").val()+"&email="+$("#email").val()+"&password="+$("#password").val()+"&repassword="+$("#repassword").val()+"&captcha="+$("#captcha").val(),
				success: function(msg){
					if(msg == "ok") {
						Swal.fire({
						  position: 'bottom-end',
						  icon: 'success',
						  title: 'Bienvenue !',
						  text: 'Vous venez de vous inscrire sur Arcade ! '+$("#username").val(),
						  showConfirmButton: false,
						  toast: true,
						  timer: 3000
						});
					}else {
						Swal.fire({
						  position: 'bottom-end',
						  icon: 'error',
						  title: 'Oops !',
						  text: msg,
						  showConfirmButton: false,
						  toast: true,
						  timer: 3000
						});
					}

					setTimeout(function() {
						document.location.reload();
					}, 3000);
				}
			});
		});
	});
	</script>
	<script type="text/javascript" src="./assets/js/modal.js"></script>