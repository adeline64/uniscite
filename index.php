<?php
//Autoload charg� AVANT la session pour cr�er les objets stock�s en session
require_once 'include/autoload.php';

// On demarre la session
session_start();

define('_DEBUG_',1);

//Les fonctions communes
require_once 'include/functions.php';

//la connexion � la base
require_once 'include/DBConnexion.php';

debug($_SESSION);

if (array_key_exists("initsession", $_POST)) {
	$_SESSION = array();
	debug($_SESSION,true);
}
?>


<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=10">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.min.css">
	<script src="lib/tether/dist/css/tether.min.css"></script>
	<script src="lib/tether/dist/css/tether-theme-arrows.min.css"></script>
	<script src="lib/tether/dist/css/tether-theme-basic.min.css"></script>
	<script src="lib/tether/dist/css/tether-theme-arrows-dark.min.css"></script>


    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_profil.css">
	<title></title>
</head>
<body>

<form method="post">
    <input type="hidden" name="initsession" value="1" />
    <input type="submit" value="Init Session" />
</form>

<?php
    include_once "code/templates/navbar.php";
?>


<div class="container">

<?php

if (empty($_SESSION['Employe'])) {
	// NON co
	// penser afficher connexion/inscription
	// par defaut == accueil

	if (!empty($_GET['page'])&& $_GET['page'] == 'inscription') {
		include_once "code/templates/inscription.php";

	} else if (!empty($_GET['page'])&& $_GET['page'] == 'connexion') {
		include_once "code/templates/connexion.php";

	}else {
		//par defaut accueil
		include_once "code/templates/accueil.php";
	}

}else{
	//connecte


    if(!empty($_GET['page'])&& $_GET['page'] == 'deconnexion') {
	    include_once "code/templates/deconexion.php";

    }else if(!empty($_GET['page'])&& $_GET['page'] == 'liste_volontaire') {
	    include_once "code/templates/liste_volontaire.php";

    }elseif (!empty($_GET['page'])&& $_GET['page'] == 'profil'){
		include_once "code/templates/profil.php";

    }else if(!empty($_GET['page'])&& $_GET['page'] == 'profil_Assurance') {
	    include_once "code/templates/profil_Assurance.php";

	}else if(!empty($_GET['page'])&& $_GET['page'] == 'profil_Vehicule') {
		include_once "code/templates/profil_Vehicule.php";

	}else if(!empty($_GET['page'])&& $_GET['page'] == 'sommaire') {
		include_once "code/templates/sommaire.tpl";

	}else if(!empty($_GET['page'])&& $_GET['page'] == 'volontaire') {
		include_once "code/templates/volontaire.php";

	}else {
		//par defaut accueil
		include_once "code/templates/accueil.php";
	}
 }
?>
<script src="lib/jquery/jquery-3.3.1.slim.min.js"></script>
<script src="lib/jsdelivr/html5shiv/dist/html5shiv.min.js"></script>
<script src="lib/jsdelivr/html5shiv/dist/html5shiv-printshiv.min.js"></script>
<script src="lib/jsdelivr/respond.min.js"></script>
<script src="lib/popper/popper.min.js"></script>
<script src="lib/tether/dist/js/tether.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="javascript/verificationForm.js"></script>
<script src="javascript/global.js"></script>
<script src="javascript/profil.js"></script>
</body>
</html>

