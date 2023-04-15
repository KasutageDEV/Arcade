<?php

function headerText($page) {

	switch ($page) {
		case 'index':
			echo '<span id="dateHeure"></span>';
			break;
		case 'article-add':
			echo 'Créer un article';
			break;
		case 'article-correct':
			echo 'Corriger un article';
			break;
		case 'article-list':
			echo 'Gérer / Modifier les articles';
			break;
		case 'article-valid':
			echo 'Valider un article';
			break;
		case 'user-rank':
			echo 'Rank un membre';
			break;
		case 'user-rankGestion':
			echo 'Gestion des rank';
			break;
		case 'user-list':
			echo 'Gestion des membres';
			break;
		case 'partenaires':
			echo 'Ajouter / Supprimer une catégorie ou un membre';
			break;
		case 'dedicaces':
			echo 'Gestion des dédicaces';
			break;
		case 'event':
			echo 'Ajouter / Gérer les events hc';
			break;
		case 'flux':
			echo 'Ajouter / Gérer les flux';
			break;
		case 'a-propos':
			echo 'Modifier le contenu de la page à propos';
			break;
		case 'bannis':
			echo 'Ajouter / Gérer les bannis';
			break;
		default:
			echo '<span id="dateHeure"></span>';
			break;
	}
}