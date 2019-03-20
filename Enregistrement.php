<?php

require_once("classes/DAOMeteo.php");

//Récupération et sécurisation des données rentrées par l'utilisateur

$new_pseudo = htmlspecialchars(trim($_POST["new_login"]));
$new_pseudo = str_replace(array("\n","\r",PHP_EOL),'',$new_pseudo);
if (preg_match("#^[a-zA-Z0-9 -]+$#", $new_pseudo)) {
	$new_pseudo = $new_pseudo;
}
else {$new_pseudo = "";}


$new_mail = htmlspecialchars(trim($_POST["new_mail"]));
$new_mail = str_replace(array("\n","\r",PHP_EOL),'',$new_mail);
if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $new_mail)) {
	$new_mail = $new_mail;
}
else {$new_mail = "";}


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

		$req = $dao->getPassword($new_pseudo);


		if (count($req) == 0) {
			$dao->getResults("INSERT INTO t_password (pseudo, mdp, email) VALUES ('$new_pseudo', '$new_mdp', '$new_mail')");
	
			require_once("Login.php");
		}

		else {
		require_once("Iteration.html");
		}
	}

}
 
else {
    require_once("Rate.html");
}


?>