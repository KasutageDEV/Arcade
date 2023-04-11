<?php

function headerTitle($page) {

	switch ($page) {
		case 'index':
			echo '<h1>Hey,</h1> <img src="./assets/imgs/emojis-mt/waving-hand_1f44b.png">';
			break;

		case 'articles':
			echo '<h1>Articles</h1> <img src="./assets/imgs/emojis-mt/newspaper_1f4f0.png">';
			break;

		case 'staffs':
			echo '<h1>Équipe</h1> <img src="./assets/imgs/emojis-mt/shield_1f6e1-fe0f.png">';
			break;

		case 'partenaires':
			echo '<h1>Partenaires</h1> <img src="./assets/imgs/emojis-mt/handshake_1f91d.png">';
			break;

		case 'flux':
			echo '<h1>Flux</h1> <img src="./assets/imgs/emojis-mt/repeat-button_1f501.png">';
			break;

		case 'dedicace':
			echo '<h1>Dédicace</h1> <img src="./assets/imgs/emojis-mt/speech-balloon_1f4ac.png">';
			break;

		case 'classement':
			echo '<h1>Classement</h1> <img src="./assets/imgs/emojis-mt/trophy_1f3c6.png">';
			break;

		case 'about':
			echo '<h1>À propos</h1> <img src="./assets/imgs/emojis-mt/exclamation-question-mark_2049-fe0f.png">';
			break;

		default:
			echo '<h1>Hey,</h1> <img src="./assets/imgs/emojis-mt/waving-hand_1f44b.png">';
			break;
	}
}