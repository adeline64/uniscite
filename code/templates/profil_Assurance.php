	<?php


	debug( $_POST, true );

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
			$_POST['typeassurance'],
			$_POST['numAssurer'],
			$_POST['adresse1'],
			$_POST['adresse2'] ) ) {

			echo "il manque une ou plusieurs donnees";

		} else {
			//remont� dans l'index
			// 		require_once '../../include/autoload.php';
			try {
				$oManagerAssurance = new ManagerAssurance(); //cr�aton d'un objet manager
				$oManagerAssurance->setDb( $db ); // on passe la connexion � l'objet manager
				$oManagerAssurance->add( $_POST );
				$Assurances = $oManagerAssurance->getAllAssurance();

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
				<form action="?page=profil_Assurance" method="post">

					<div class="form-group">
						<label for="nom"> Nom : </label><input type="text" class="form-control" aria-describedby="nom"  id="nom" name="nom">
					</div>
					<span id="nom_manquant">
                    </span>

					<div class="form-group">
						<label for="codePostal"> Code Postal : </label><input type="text" class="form-control" aria-describedby="code Postal"  id="codePostal" name="codePostal">
					</div>
					<span id="code_manquant">
                    </span>

					<div class="form-group">
						<label for="email"> email : </label><input type="email" class="form-control" aria-describedby="email"  id="email" name="email">
					</div>
					<span id="email_manquant">
                    </span>

					<div class="form-group">
						<label for="ville"> ville : </label><input type="text" class="form-control" aria-describedby="ville"  id="ville" name="ville">
					</div>
					<span id="ville_manquant">
                    </span>

					<div class="form-group">
						<label for="telephone"> telephone : </label><input type="text" class="form-control" aria-describedby="telephone"  id="telephone" name="telephone">
					</div>
					<span id="telephone_manquant">
                    </span>

					<div class="form-group">
						<label for="pays"> Pays : </label><input type="text" class="form-control" aria-describedby="pays"  id="pays" name="pays">
					</div>

                    <div class="form-group">
                        <label for="typeassurance"> Type Assurance : </label> <br>
                        <input type="radio" name="typeassurance" value="1" >vie &nbsp; <br>
                        <input type="radio" name="typeassurance" value="2">habitation &nbsp; <br>
                        <input type="radio" name="typeassurance" value="3">vehicule &nbsp;
                    </div>

					<div class="form-group">
						<label for="numAssurer"> Numero d'assurer : </label><input type="text" class="form-control" aria-describedby="numAssurer"  id="numAssurer" name="numAssurer">
					</div>

					<div class="form-group">
						<label for="adresse1"> adresse : </label><input type="text" class="form-control" aria-describedby="adresse1"  id="adresse1" name="adresse1">
					</div>
					<span id="adresse1_manquant">
                    </span>

					<div class="form-group">
						<label for="adresse2"> adresse : </label><input type="text" class="form-control" aria-describedby="adresse2"  id="adresse2" name="adresse2">
					</div>


					<p>
						<input type="submit" name="inscription" id="button" class="btn-inscrit" value="enregistrer">
					</p>

				</form>
			</section>

		</div>
	</div>


