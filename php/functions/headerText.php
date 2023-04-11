<?php

function headerText($page) {

	switch ($page) {
		case 'index':
			echo "<h2>Découvrez un univers captivant où innovation et créativité fusionnent pour révolutionner votre expérience en ligne !<br><span>Bienvenue à l'aventure de demain !</span></h2>";
			break;
		case 'articles':
			echo "<h2>Plongez dans notre bibliothèque d'articles, où chaque clic vous ouvre les portes d'un savoir fascinant et d'histoires captivantes à explorer <span>sans modération.</span></h2>";
			break;
		case 'staffs':
			echo "<h2>Rencontrez notre équipe <span>passionnée</span>, unie par la diversité de ses talents et l'ambition de transformer vos rêves en réalités.<br><span>Ensemble, nous bâtissons l'avenir.</span></h2>";
			break;
		case 'partenaires':
			echo "<h2>Découvrez nos partenaires <span>précieux</span>, un réseau de collaboration et de soutien mutuel<br>Qui ensemble contribuent à façonner un avenir <span>meilleur pour tous.</span></h2>";
			break;
		case 'flux':
			echo "<h2>Découvrez l'évolution dynamique de notre équipe, où chaque changement reflète notre engagement à grandir ensemble.<br><span>Et à vous offrir le meilleur de nous-mêmes.</span></h2>";
			break;
		case 'dedicace':
			echo "<h2>Exprimez votre gratitude et votre affection avec une <span>dédicace personnalisée</span><br>Créant des souvenirs inoubliables et renforçant les <span>liens qui nous unissent.</span></h2>";
			break;
		case 'classement':
			echo "<h2>Explorez le classement, un miroir de <span>l'excellence</span> et de la <span>compétition saine</span>.<br>Où les meilleurs se démarquent et où chacun est <span>motivé à se surpasser.</span></h2>";
			break;
		case 'about':
			echo "<h2>Apprenez-en davantage sur <span>notre histoire</span>, notre mission et nos valeurs<br>Car derrière chaque succès se cache une vision partagée et <span>une passion qui nous anime.</span></h2>";
			break;
		default:
			echo "<h2>Bienvenue sur le blog <span>N°1</span> sur l'actualité de <span>HabboCity</span></h2>";
			break;
	}
}