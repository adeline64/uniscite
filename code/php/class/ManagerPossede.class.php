<?php


class ManagerPossede extends Manager {

	public function __construct( $mode = 'prod' ) {
		debug( '<br>[debug]Dans "' . __CLASS__ . "::" . __FUNCTION__ . '" [/debug]', true );
		parent::__construct( $mode );
	}


	public function addPossedeEmploye($idemploye=0,$idvehicule=0) {
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (is_null($this->db)) {
			throw new Exception("PAS DE CONNEXION A LA BASE");
		}
		if ($idemploye == 0 && $idvehicule ==0) {
			throw new Exception("PAS DE DONNEE A TRAITER");
		}
		$req = "INSERT INTO possede(employe,vehicule) VALUES (:employe,:vehicule)";
		$stmt = $this->db->prepare($req);
		$stmt->bindValue('employe',$idemploye);
		$stmt->bindValue('vehicule',$idvehicule);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			debug('<br>[debug]OK 1 ligne Ajoutee');
		} else {
			debug('<br>Erreur suppression donnees');
			throw new Exception("Erreur de Ajout ".__CLASS__." (idemploye: ".$idemploye.", idvehicule: ".$idvehicule.")");
		}
	}

	public function addPossedeVolontaire($idvolontaire=0,$idvehicule=0) {
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (is_null($this->db)) {
			throw new Exception("PAS DE CONNEXION A LA BASE");
		}
		if ($idvolontaire == 0 && $idvehicule ==0) {
			throw new Exception("PAS DE DONNEE A TRAITER");
		}
		$req = "INSERT INTO possede(volontaire,vehicule) VALUES (:volontaire,:vehicule)";
		$stmt = $this->db->prepare($req);
		$stmt->bindValue('volontaire',$idvolontaire);
		$stmt->bindValue('vehicule',$idvehicule);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			debug('<br>[debug]OK 1 ligne Ajoutee');
		} else {
			debug('<br>Erreur suppression donnees');
			throw new Exception("Erreur de Ajout ".__CLASS__." (idvolontaire: ".$idvolontaire.", idvehicule: ".$idvehicule.")");
		}
	}




	/**
	 * Fonction de modification d'une ligne dans la table
	 * {@inheritDoc}
	 * @see Manager::update()
	 */
	public function update($id=0,$idemploye=0,$idvolontaire=0,$idvehicule=0) {
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (is_null($this->db)) {
			throw new Exception("PAS DE CONNEXION A LA BASE");
		}
		if ($id == 0 && $idemploye == 0 && $idvolontaire == 0 && $idvehicule ==0) {
			throw new Exception("PAS DE DONNEE A TRAITER");
		}
		$req = "UPDATE possede SET employe=:employe, volontaire=:volontaire,vehicule=:vehicule WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->bindValue('employe',$idemploye);
		$stmt->bindValue('volontaire',$idvolontaire);
		$stmt->bindValue('vehicule',$idvehicule);
		$stmt->bindValue('id',$id);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			debug('<br>[debug]OK 1 ligne modifiee');
		} else {
			debug('<br>Erreur suppression donnees');
			throw new Exception("Erreur de modification ".__CLASS__." (id: ".$id.", idemploye: ".$idemploye.", idvolontaire: ".$idvolontaire.", idvehicule: ".$idvehicule.")");
		}
	}

	/**
	 * Fonction de suppression d'une ddonn?e dans la table 'possede'
	 * ? partir de son identifiant de table
	 * {@inheritDoc}
	 * @see Manager::delete()
	 */
	public function delete($id) {
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (is_null($this->db)) {
			throw new Exception("PAS DE CONNEXION A LA BASE");
		}
		$req = "DELETE FROM possede WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->bindValue('id',$id);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			debug('<br>[debug]OK 1 ligne supprimee');
		} else {
			debug('<br>Erreur suppression donnees');
			throw new Exception("Erreur de suppression ".__CLASS__." ID (".$id.")");
		}
	}



}