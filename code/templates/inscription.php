<?php
    debug($_POST);
	echo '<pre>'.print_r($_POST,true).'</pre>';
	$_GET['page']='connexion';
	if (!empty($_POST)) {
		if ( ! isset
		(
			$_POST['nom'],
			$_POST['prenom'],
			$_POST['adresse1'],
			$_POST['adresse2'],
			$_POST['codePostal'],
			$_POST['email'],
			$_POST['ville'],
			$_POST['pays'],
			$_POST['telephone'],
			$_POST['handicap'],
			$_POST['permis'],
			$_POST['password']


		))
		{
			echo "il manque une ou plusieurs donnees";
		} else {
			try {
				$manager = new ManagerEmploye();
				$manager->setDb($db);
				$manager->add( $_POST );
			} catch ( LengthException $lengthException ) {
//cas longueur == 0
				echo $lengthException->GetMessage();
			} catch ( Exception $exception ) {
//aute cas (mais pour nous invalide)
				echo $exception->GetMessage();
			}

		}
		header("Location: index.php?page=connexion");
	}





	?>


	<div class= "row align-items-start">
		<div class= "col-12 col-md-8 unis_volontaire">
			<section class="page-section">
				<form action="?page=inscription" method="post">
					<div class="form-group">
						<label for="nom"> Nom : </label><input type="text" class="form-control" aria-describedby="nom" id="nom" name="nom">
					</div>
					<span id="nom_manquant">
                    </span>

					<div class="form-group">
						<label for="prenom"> Prenom : </label><input type="text" class="form-control" aria-describedby="Prenom" id="prenom" name="prenom">
					</div>
					<span id="prenom_manquant">
                    </span>

					<div class="form-group">
						<label for="adresse1"> Adresse : </label><input type="text" class="form-control" aria-describedby="Adresse"  id="adresse1" name="adresse1">
					</div>
					<span id="Adresse_manquant">
                    </span>

					<div class="form-group">
						<label for="adresse2"> Adresse : </label><input type="text" class="form-control" aria-describedby="Adresse"  id="adresse2" name="adresse2">
					</div>

					<div class="form-group">
						<label for="codePostal"> Code Postal : </label><input type="text" class="form-control" aria-describedby="codePostal"  id="codePostal" name="codePostal">
					</div>
					<span id="code_manquant">
                    </span>

					<div class="form-group">
						<label for="ville"> Ville : </label><input type="text" class="form-control" aria-describedby="ville"  id="ville" name="ville">
					</div>
					<span id="ville_manquant">
                    </span>

					<div class="form-group">
						<label for="pays"> Pays : </label><input type="text" class="form-control" aria-describedby="Pays"  id="pays" name="pays">
					</div>
					<span id="Pays_manquant">
                    </span>

                    <div class="form-group">
                        <label for="handicape"> handicape ( si oui : rqth ou autre) : </label>
                        <input type="radio" name="handicap" value="oui">oui &nbsp;
                        <input type="radio" name="handicap" value="non">non
                        <label for="quelhandicap"> Lequel?</label>
                        <input type="text" class="form-control" aria-describedby="handicapee" id="quelhandicap" name="typeHandicap">
                    </div>

					<div class="form-group">
						<label for="permis"> permis : </label><input type="text" class="form-control" aria-describedby="permis" id="permis" name="permis">
					</div>

					<div class="form-group">
						<label for="telephone"> t&eacute;l&eacute;phone : </label><input type="tel" class="form-control" aria-describedby="telephone" id="telephone" name="telephone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
					</div>
					<span id="telephone_manquant">
                    </span>

					<div class="form-group">
						<label for="email"> e-mail : </label><input type="email" class="form-control" aria-describedby="email" id="email" name="email">
					</div>
					<span id="email_manquant">
                    </span>

					<div class="form-group">
						<label for="password"> Mot de passe : </label><input type="password" class="form-control" aria-describedby="password"  id="password" name="password">
					</div>
					<span id="password_manquant">
                    </span>


					<p>
						<input type="submit" name="inscription" id="button" class="btn-inscrit" value="Inscription">
					</p>
				</form>
			</section>

			<p class="connect">Vous d&eacute;sirez vous connecter ? Rendez vous sur cette <a href="?page=connexion" name="page">
					page.
			</p>

		</div>
	</div>
