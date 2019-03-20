<?php

require_once("classes/DAOMeteo.php");

session_start();

$passw = htmlspecialchars($_POST["password"]);
$passw = str_replace(array("\n","\r",PHP_EOL),'',$passw);
$passw = hash('sha512', $passw);
 

$pseudo = htmlspecialchars($_POST["login"]);
$pseudo = str_replace(array("\n","\r",PHP_EOL),'',$pseudo);


/* création d'une instance */
$dao = new DAOMeteo();
/* on se connecte */
$dao->connexion();


if (!$dao->getLastError()) {                            /* on récupère les utilisateurs */


$req = $dao->getPassword($pseudo);


    if (count($req) > 0) {

        $mot_de_passe = $req;

        if ($passw == $mot_de_passe[0]["mdp"]) {

            $_SESSION["connected_user"] = $pseudo;
    
        }

        else {
            require_once("Erreur.html");
        }

    }

    else {
        require_once("Erreur.html");
    }



    if (isset($_SESSION["connected_user"])) {
        if($_SESSION["connected_user"]=="admin") { 
            require_once("ForecastA.php");
        } else {
            require_once("Forecast.php");
        }
    }

}


?>