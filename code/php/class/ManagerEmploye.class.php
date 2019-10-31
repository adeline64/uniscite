<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 24/01/2019
 * Time: 20:52
 */

class ManagerEmploye extends Manager {

	public function __construct($mode='prod'){
	    parent::__construct($mode);
	}

	public function read($id){
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req = $this->db->prepare('SELECT * FROM employe WHERE id =:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$employe = new employe($array);

		return $employe;
	}

	public function add($data) {
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		//bloc try/catch pour gérer les exceptions
		//provenant de Employer
		try {
		    $employe = new employe($data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
		$req = $this->db->prepare('INSERT INTO employe (nom,prenom,adresse1,adresse2,codePostal,ville,pays,email,telephone,handicap,permis,password) VALUES (:nom,:prenom,:adresse1,:adresse2,:codePostal,:ville,:pays,:email,:telephone,:handicap,:permis,:password)');
		$req->bindValue('nom', $employe->getNom(), PDO::PARAM_STR);
		$req->bindValue('prenom', $employe->getPrenom(), PDO::PARAM_STR);
		$req->bindValue('adresse1', $employe->getAdresse1(), PDO::PARAM_STR);
		$req->bindValue('adresse2', $employe->getAdresse2(), PDO::PARAM_STR);
		$req->bindValue('codePostal', $employe->getCodePostal(), PDO::PARAM_STR);
		$req->bindValue('ville', $employe->getVille(), PDO::PARAM_STR);
		$req->bindValue('pays', $employe->getPays(), PDO::PARAM_STR);
		$req->bindValue('email', $employe->getEmail(), PDO::PARAM_STR);
		$req->bindValue('telephone', $employe->getTelephone(), PDO::PARAM_STR);
		$req->bindValue('handicap', ((is_null($employe->getHandicap())) ? ' ' : $employe->getHandicap()), PDO::PARAM_STR);
		$req->bindValue('permis', $employe->getPermis(), PDO::PARAM_STR);
		$req->bindValue('password', password_hash($employe->getPassword(),PASSWORD_BCRYPT), PDO::PARAM_STR);


		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$employe->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}

	}

	public function getAllEmploye() {

		$stmt = $this->db->query("SELECT * FROM employe");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getEmploye( $id ) {
		$stm = "SELECT * FROM employe WHERE id=:id";
		//preparation == protection des donn?es ? venir
		$stmt = $this->db->prepare( $stm );
		//liaison des marqueur :toto aux donnees
		$stmt->bindValue( 'id', $id, PDO::PARAM_INT );
		//execution de la requete sur le serveur SQL
		$stmt->execute();

		return $stmt;
	}

	public function update($data){
		echo '<pre>' . print_r( $data, true ) . '</pre>';

		echo '<br>[debug]SESSION';
		echo '<pre>' . print_r( $data, true ) . '</pre>';

		$req = $this->db->prepare('UPDATE employe SET nom=:nom,prenom=:prenom,adresse1=:adresse1,adresse2=:adresse2,codePostal=:codePostal,ville=:ville,pays=:pays,email=:email, telephone=:telephone, handicap=:handicap, permis=:permis, password=:password WHERE id=:id');
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT );
		$req->bindValue('nom', $data->getNom(), PDO::PARAM_STR);
		$req->bindValue('prenom', $data->getPrenom(), PDO::PARAM_STR);
		$req->bindValue('adresse1', $data->getAdresse1(), PDO::PARAM_STR);
		$req->bindValue('adresse2', $data->getAdresse2(), PDO::PARAM_STR);
		$req->bindValue('codePostal', $data->getCodePostal(), PDO::PARAM_STR);
		$req->bindValue('ville', $data->getVille(), PDO::PARAM_STR);
		$req->bindValue('pays', $data->getPays(), PDO::PARAM_STR);
		$req->bindValue('email', $data->getEmail(), PDO::PARAM_STR);
		$req->bindValue('telephone', $data->getTelephone(), PDO::PARAM_STR);
		$req->bindValue('handicap', $data->getHandicap(), PDO::PARAM_STR);
		$req->bindValue('permis', $data->getPermis(), PDO::PARAM_STR);
		$req->bindValue('password', $data->getPassword(), PDO::PARAM_STR);
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}
	}


	public function connecte($email,$password) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		$req = $this->db->prepare( 'SELECT * FROM employe WHERE email=:email' );
		$req->bindValue( 'email', $email );
		$req->execute();
		$data = $req->fetch();
		if ( empty( $data ) ) {
			throw new Exception( 'Mauvais email' );
		} else {
			$employe = new employe($data);
			debug($employe, TRUE);
			if ( password_verify( $password, $employe->getPassword() ) ) {
				//OK c'est le bon
				return $employe;
			} else {
				//rallage
				throw new Exception( 'Mauvais mot de passe' );
			}
		}
	}

	public function delete( $id ) {
		// =>voir  getLivre(id) pour modele
		$req  = "DELETE FROM employe WHERE id=:id";
		$stmt = $this->db->prepare( $req );
		$stmt->execute();
		if ( $stmt->rowCount() == 1 ) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}

	}



}