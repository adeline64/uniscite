<?php

    if (empty($_SESSION['Employe'])) {
	//NON Co


	?>

<div class= "row align-items-start">
    <div class="header-text hidden-xs">
        <div class="col-12 col-md-12 text-center unis_quest">
            <h2 class="faire">
                    <span>
                        Que d&eacute;sirez vous faire ?
                    </span>
            </h2>
        </div>
        <br>
        <div class="col-12 col-md-12 unis_bouton">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a class="btn btn-connect" button type="button-middle" href="?page=connexion.php" title="Ouvrir la page">Se connecter</a>&nbsp;
                <a class="btn btn-inscrit" button type="button-middle" href="?page=inscription.php" title="Ouvrir la page">S'inscrire</a>
            </div>
        </div>
    </div>
</div>




<?php

}else{

	?>

<div class= "row align-items-start" >
    <div class= "col-12 col-md-4 unis">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="?page=volontaire.php" class="btn btn-Volontaire" role="button" title="Ouvrir la page">Inscription Volontaire</a>﻿
            </br>
        </div>
    </div>
</div>

<?php
}