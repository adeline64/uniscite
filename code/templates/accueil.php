<?php


if ( empty( $_SESSION['Employe'] ) ) {
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
                    <a class="btn btn-connect" button type="button-middle" href="?page=connexion" title="Ouvrir la page">Se connecter</a>&nbsp;
                    <a class="btn btn-inscrit" button type="button-middle" href="?page=inscription" title="Ouvrir la page">S'inscrire</a>
                </div>
            </div>
        </div>
    </div>

	<?php

}else {
	?>

    <div class="row align-items-start">
        <div class="col-12 col-md-12 unis_accueil">

            <h1 class="Bienvenue">
                Bienvenue &agrave; Unis-Cit&eacute;
            </h1>

            <p class="sommaire">
                Merci de vous rendre dans le <a href="?page=sommaire" name="sommaire">sommaire</a> pour participer
                &agrave; l'aventure d'Unis-Cit&eacute;
            </p>
        </div>
    </div>

	<?php
}