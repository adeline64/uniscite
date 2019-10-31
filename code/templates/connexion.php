<?php
if (!empty($_POST)) {
	echo '<br>$_POST non vide';
	echo '<br>Donnees envoyees:';
	echo '<pre>'.print_r($_POST,true).'</pre>';



	$oManagerEmploye = new ManagerEmploye();
	$oManagerEmploye -> setDb($db);
//connexion de l'utilisateur
	$_SESSION['Employe'] = $oManagerEmploye->connecte($_POST['email'], $_POST['password']);

//redirection
	header("Location: index.php?page=profil");


}
?>



<div class= "row align-items-start">
	<div class= "col-12 col-md-8 owl_connect">
		<section class="page-section">
			<form action="?page=connexion" method="post">
				<div class="form-group">
					<label for="mail"> E-mail : </label>
					<input type="email" class="form-control" aria-describedby="email" id="email" name="email">
				</div>
				<span id="email_manquant">
                    </span>
				<div class="form-group">
					<label for="password"> Mot de passe : </label>
					<input type="password" class="form-control" aria-describedby="password" id="password" name="password">
				</div>
				<span id="password_manquant">
                    </span>
				<p>
					<input type="submit" name="connexion" id="button" class="btn_connexion" value="Connexion">
				</p>
			</form>
		</section>

		<p class="inscrit">Vous d&eacute;sirez vous inscrire ? Rendez vous sur cette <a href="?page=inscription" name="page">
				page.
		</p>

	</div>
</div>