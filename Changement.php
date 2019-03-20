<?php

require_once("classes/DAOMeteo.php");

//Récupération et sécurisation des données rentrées par l'utilisateur

$lost_pseudo = htmlspecialchars(trim($_POST["lost_login_again"]));
$lost_pseudo = str_replace(array("\n","\r",PHP_EOL),'',$lost_pseudo);
if (preg_match("#^[a-zA-Z0-9 -]+$#", $lost_pseudo)) {
	$lost_pseudo = $lost_pseudo;
}
else {$lost_pseudo = "";}



$new_mdp = htmlspecialchars(trim($_POST["new_password"]));
$new_mdp = str_replace(array("\n","\r",PHP_EOL),'',$new_mdp);
if (preg_match("#^[a-zA-Z0-9&@ -]+$#", $new_mdp)) {
	$new_mdp = $new_mdp;
}
else {$new_mdp = "";}
$new_mdp = hash('sha512', $new_mdp);



$conf_mdp = htmlspecialchars(trim($_POST["conf_password"]));
$conf_mdp = str_replace(array("\n","\r",PHP_EOL),'',$conf_mdp);
if (preg_match("#^[a-zA-Z0-9&@ -]+$#", $conf_mdp)) {
	$conf_mdp = $conf_mdp;
}
else {$conf_mdp = "";}
$conf_mdp = hash('sha512', $conf_mdp);


/* création d'une instance */
$dao = new DAOMeteo();
/* on se connecte */
$dao->connexion();

if ($new_mdp == $conf_mdp) {

	if (!$dao->getLastError()) {                            /* on récupère les utilisateurs */

// Requête SQL sécurisée

		$req = $dao->getPassword($lost_pseudo);


		if (count($req) > 0) {
			$dao->getResults("UPDATE t_password SET mdp = '$new_mdp' WHERE pseudo = '$lost_pseudo'");
	
			require_once("Login.php");
		}

		else {
		require_once("RateDorryident.html");
		}
	}

}
 
else {
    require_once("RateChangement.html");
}


?>