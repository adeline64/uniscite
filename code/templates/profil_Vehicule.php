<?php

	debug( $_POST, true );

	echo '<pre>' . print_r( $_POST, true ) . '</pre>';
	$_GET['page'] = 'connexion';
	if ( ! empty( $_POST ) ) {
		if ( ! isset(
			$_POST['nom'],
			$_POST['type_vehicule'],
			$_POST['immatriculation'] ) ) {

			echo "il manque une ou plusieurs donnees";

		} else {
			//remont� dans l'index
			// 		require_once '../../include/autoload.php';
			try {
				$oManagerVehicule = new ManagerVehicule(); //cr�aton d'un objet manager
				$oManagerVehicule->setDb( $db ); // on passe la connexion � l'objet manager
				$oManagerVehicule->add( $_POST );
				$vehicules = $oManagerVehicule->getAllVehicule();

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
			<section class="page-section">
				<form action="?page=profil_Vehicule" method="post">

					<div class="form-group">
						<label for="nom"> Nom : </label><input type="text" class="form-control" aria-describedby="nom"  id="nom" name="nom">
					</div>
					<span id="nom_manquant">
                    </span>

					<div class="form-group">
						<label for="type_vehicule"> Type Vehicule : </label><input type="text" class="form-control" aria-describedby="type_vehicule"  id="type_vehicule" name="type_vehicule">
					</div>

					<div class="form-group">
						<label for="immatriculation"> Immatriculation : </label><input type="text" class="form-control" aria-describedby="immatriculation"  id="immatriculation" name="immatriculation">
					</div>
					<span id="ville_manquant">
                    </span>


					<p>
						<input type="submit" name="inscription" id="button" class="btn-inscrit" value="Inscription">
					</p>


				</form>
			</section>

		</div>
	</div>
