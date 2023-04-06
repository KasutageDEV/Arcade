<?php
try {
    $host = "localhost"; // Hôte de ta base de données.
    $nom_bdd = "arcade"; //Nom de ta base de données.
    $user_bdd = "root"; // Nom d'utilisateur de ta base de données.
    $mdp_bdd = ""; // Le mot de passe de ta base de données.
   	$bdd = new PDO('mysql:host='.$host.';dbname='.$nom_bdd.';charset=utf8', ''.$user_bdd.'', ''.$mdp_bdd.'');
   	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}

catch(Exception $e) {
	die('Erreur : ' . $e->getMessage());
}
?>