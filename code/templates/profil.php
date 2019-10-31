<?php

	    echo '<pre>' . print_r( $_POST, true ) . '</pre>';
	    $_GET['page'] = 'connexion';
	    if ( ! empty( $_POST ) ) {
		    if ( ! isset(
		            $_POST['nom'],
                    $_POST['codePostal'],
                    $_POST['email'],
                    $_POST['ville'],
                    $_POST['telephone'],
                    $_POST['pays'],
                    $_POST['numAssurer'],
                    $_POST['adresse1'],
                    $_POST['adresse2'] ) ) {

			    echo "il manque une ou plusieurs donnees";

		    } else {
			    //remont� dans l'index
			    // 		require_once '../../include/autoload.php';
			    try {

				    $oManagerEmploye = new ManagerEmploye(); //cr�aton d'un objet manager
				    $oManagerEmploye->setDb( $db ); // on passe la connexion � l'objet manager
				    $oManagerEmploye->add( $_POST );
				    $Employe = $oManagerEmploye->getAllEmploye();


				    //devenu inutile => a supprimer
				    //require_once( 'accueil.tpl' );
				    //redirection vers la connexion
				    $_GET['page'] = 'accueil';
			    } catch ( LengthException $lengthException ) {
				    //cas longueur == 0
				    echo $lengthException->GetMessage();
			    } catch ( Exception $exception ) {
				    //aute cas (mais pour nous invalide)
				    echo $exception->GetMessage();
			    }

		    }
	    }
		    ?>
            <div class="row align-items-start">
                <div class="col-12 col-md-8 unis_volontaire">
                    <section class="content">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-filter"
                                                    onclick="afficheCacheDiv('profil')">Mon Profil
                                            </button>
                                            <button type="button" class="btn btn-warning btn-filter"
                                                    onclick="afficheCacheDiv('assurance')">Mon Assurance
                                            </button>
                                            <button type="button" class="btn btn-danger btn-filter"
                                                    onclick="afficheCacheDiv('Vehicule')">Vehicule
                                            </button>
                                            <button type="button" class="btn btn-default btn-filter"
                                                    onclick="afficheCacheDiv('medical')">M&eacute;dical
                                            </button>
                                        </div>
                                    </div>


                                    <div id="profil">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="media">

                                                        <div class="media-body">
                                                            <span class="media-meta pull-right"></span>
                                                            <h4 class="title">
                                                                <?php

                                                                echo '<table>' . PHP_EOL;
                                                                echo '    <tr>' . PHP_EOL;
                                                                echo '        <td><input type="text" name="nom" id="nom" value="' . $_SESSION['Employe']->getNom() . '" disabled/>&nbsp;</td>' . PHP_EOL;
                                                                echo '    </tr>' . PHP_EOL;
                                                                echo '    <tr>' . PHP_EOL;
                                                                echo '        <td><input type="text" name="prenom" id="prenom" value="' . $_SESSION['Employe']->getPrenom() . '" disabled/>&nbsp;</td>' . PHP_EOL;
                                                                echo '    </tr>' . PHP_EOL;
                                                                echo '</table>' . PHP_EOL;
                                                                ?>
                                                                <span class="pull-right pagado"></span>
                                                            </h4>
                                                            <p class="summary">
                                                                <?php
                                                                    echo '<table>' . PHP_EOL;
                                                                        echo '    <tr>' . PHP_EOL;
                                                                            echo '        <td><input type="text" name="adresse1" id="adresse1" value="' . $_SESSION['Employe']->getAdresse1() . '" disabled/>&nbsp;</td>' . PHP_EOL;
                                                                        echo '    </tr>' . PHP_EOL;
                                                                        echo '    <tr>' . PHP_EOL;
                                                                            echo '        <td><input type="text" name="adresse2" id="adresse2" value="' . $_SESSION['Employe']->getAdresse2() . '" disabled/>&nbsp;</td>' . PHP_EOL;
                                                                        echo '    </tr>' . PHP_EOL;
                                                                        echo '    <tr>' . PHP_EOL;
                                                                            echo '        <td><input type="text" name="codePostal" id="codePostal" value="' . $_SESSION['Employe']->getCodePostal() . '" disabled/>&nbsp;</td>' . PHP_EOL;
                                                                        echo '    </tr>' . PHP_EOL;
                                                                        echo '    <tr>' . PHP_EOL;
                                                                            echo '        <td><input type="text" name="ville" id="ville" value="' . $_SESSION['Employe']->getVille() . '" disabled/>&nbsp;</td>' . PHP_EOL;
                                                                        echo '    </tr>' . PHP_EOL;
                                                                        echo '    <tr>' . PHP_EOL;
                                                                            echo '        <td><input type="text" name="telephone" id="telephone" value="' . $_SESSION['Employe']->getTelephone() . '" disabled/>&nbsp;</td>' . PHP_EOL;
                                                                        echo '    </tr>' . PHP_EOL;
                                                                    echo '</table>' . PHP_EOL;
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div id="assurance">
                                        <table>
                                            <tr>
                                                <div class="media">
                                                    <div>
                                                        <div class="media-body">
                                                            <span class="media-meta pull-right"></span>
                                                            <h4 class="title">
                                                                Assurance
                                                                <span class="pull-right pendiente"></span>
                                                            </h4>
                                                            <p class="summary">
                                                                Inscrivez vos assurances
                                                                <?php
                                                                    include_once "profil_Assurance.php";
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>

                                    <div id="Vehicule">
                                        <table>
                                            <tr>
                                                <div class="media">


                                                    <div class="media-body">
                                                        <span class="media-meta pull-right"></span>
                                                        <h4 class="title">
                                                            Vehicule
                                                            <span class="pull-right cancelado"></span>
                                                        </h4>
                                                        <p class="summary">

                                                            Inscrivez votre véhicule

	                                                        <?php
                                                                include_once "profil_Vehicule.php";
	                                                        ?>
                                                    </div>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                    <div id="medical">
                                        <table>
                                            <tr>
                                                <div class="media">



                                                    <div class="media-body">
                                                        <span class="media-meta pull-right"></span>
                                                        <h4 class="title">
                                                            Medical
                                                            <span class="pull-right pagado"></span>
                                                        </h4>
                                                        <p class="summary">

                                                            <form action="?page=profil" method="post">

    <?php
                                                                echo '<table>' . PHP_EOL;
                                                                echo '    <caption></caption>';
                                                                echo '    <tr>' . PHP_EOL;
                                                                echo '        <td><input type="text" name="handicap" id="handicap" value="' . $_SESSION['Employe']->getHandicap() . '" disabled/>&nbsp;' . PHP_EOL;
                                                                echo '    </tr>' . PHP_EOL;
    ?>
                                                        </form>


                                                        </p>
                                                    </div>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

