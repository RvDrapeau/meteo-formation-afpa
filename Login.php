<?php
session_write_close();
session_start();
unset($_SESSION["connected_user"]);

?>

<html>

<head>

    <title>Page Login</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/Login.css">

</head>



<body>

<div class="contenu">

<h1>Page de Connexion</h1>




    <form action="Verification.php" method="POST">
        Identifiant: <input name="login" type="text" required><br>
        Mot de passe: <input name="password" type="password" required><br>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>


    <p><a href="Inscription.html">créer un compte utilisateur</a><p>
    <p><a href="Dorry.html">mot de passe perdu</a></p>

</div>

<address>Site crée par Hervé Drapeau</address>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

</body>

</html>