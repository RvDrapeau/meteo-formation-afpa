<?php

require_once("classes/DAOMeteo.php");

$lost_pseudo = htmlspecialchars(trim($_POST["lost_login"]));
$lost_pseudo = str_replace(array("\n","\r",PHP_EOL),'',$lost_pseudo);
if (preg_match("#^[a-zA-Z0-9 -]+$#", $lost_pseudo)) {
	$lost_pseudo = $lost_pseudo;
}
else {$lost_pseudo = "";}


$lost_mail = htmlspecialchars(trim($_POST["lost_mail"]));
$lost_mail = str_replace(array("\n","\r",PHP_EOL),'',$lost_mail);
if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $lost_mail)) {
	$lost_mail = $lost_mail;
}
else {$lost_mail = "";}


/* création d'une instance */
$dao = new DAOMeteo();
/* on se connecte */
$dao->connexion();




if (!$dao->getLastError()) {                            /* on récupère les utilisateurs */

// Requête SQL sécurisée

	$req = $dao->getEmail($lost_pseudo);


    if (count($req) > 0) {

        $v_email = $req;

        if ($lost_mail == $v_email[0]["email"]) {

            require_once("BravoDorry.html");
    
        }

        else {
            require_once("RateDorrymail.html");
        }

    }

    else {
        require_once("RateDorry.html");
    }
}

?>