<?php


class ManagerVehicule extends Manager {

	public function __construct($mode='prod'){
		parent::__construct($mode);
	}

	public function read($id){
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req = $this->db->prepare('SELECT * FROM vehicule WHERE id =:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$vehicule = new vehicule($array);

		return $vehicule;
	}

	public function add($data) {
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		//bloc try/catch pour gérer les exceptions
		//provenant de Employer
		try {
			$vehicule = new vehicule($data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
		$req = $this->db->prepare('INSERT INTO vehicule (nom,type_vehicule,immatriculation) VALUES (:nom,:type_vehicule,:immatriculation)');
		$req->bindValue('nom', $vehicule->getNom(), PDO::PARAM_STR);
		$req->bindValue('type_vehicule', $vehicule->getType_Vehicule(), PDO::PARAM_STR);
		$req->bindValue('immatriculation', $vehicule->getImmatriculation(), PDO::PARAM_STR);

		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$vehicule->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}

	}

	public function getAllVehicule() {


		$stmt = $this->db->query("SELECT * FROM vehicule");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getVehicule( $id ) {
		$stm = "SELECT * FROM vehicule WHERE id=:id";
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

		$req = $this->db->prepare('UPDATE vehicule SET nom=:nom,type_vehicule=:type_vehicule,immatriculation=:immatriculation WHERE id=:id');
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT );
		$req->bindValue('nom', $data->getNom(), PDO::PARAM_STR);
		$req->bindValue('type_vehicule', $data->getType_Vehicule(), PDO::PARAM_STR);
		$req->bindValue('immatriculation', $data->getImmatriculation(), PDO::PARAM_STR);
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}
	}


	public function delete( $id ) {
		// =>voir  getLivre(id) pour modele
		$req  = "DELETE FROM vehicule WHERE id=:id";
		$stmt = $this->db->prepare( $req );
		$stmt->execute();
		if ( $stmt->rowCount() == 1 ) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}

	}



}