<?php

    if (empty($_SESSION['Employe'])) {
	    //NON Co

//NON Co
	?>

        <nav class="navbar navbar-light bg-faded Unis_NavBarre">
            <h1 class="navbar-brand mb-0 Bienvenue">
                Bienvenue
            </h1>
            <a class="navbar-brand" href="#">
                <img src="image/uniscite2.png" alt="photo_utilisateur" class="uniscite" data-toggle="modal">
            </a>
        </nav>
	<?php

}else {
	?>


        <nav class="navbar navbar-toggleable-md navbar-light bg-faded Uniscite_NavBarre">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon">
	        </span>
            </button>
            <div class="Uniscite">
	            <?php
	                echo strtoupper($_SESSION['Employe']->getNom()) . ' ' . $_SESSION['Employe']->getPrenom();
	            ?>
                <a class="navbar-brand" href="#">
                    <img src="image/uniscite2.png" title="unis" alt="logo_uniscite" class="logo" data-toggle="modal">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#"></a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=volontaire">Inscription Volontaire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=deconexion">Deconexion</a>
                    </li>
                </ul>
            </div>
        </nav>


	<?php
}