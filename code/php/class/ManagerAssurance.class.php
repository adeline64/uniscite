<?php


class ManagerAssurance extends Manager{
	public function __construct( $mode = 'prod' ) {
		debug( '<br>[debug]Dans "' . __CLASS__ . "::" . __FUNCTION__ . '" [/debug]', true );
		parent::__construct( $mode );
	}


	public function read( $id ) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		$req = $this->db->prepare( 'SELECT * FROM assurance WHERE id =:id' );
		$req->bindValue( 'id', $id, PDO::PARAM_INT );
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$oAssurance = new assurance( $array );

		return $oAssurance;
	}

	public function add( $data ) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		//bloc try/catch pour g�rer les exceptions
		//provenant de Employer
		try {
			$oAssurance = new assurance( $data );
		} catch ( LengthException $lengthException ) {
			//cas longueur == 0
			throw new Exception( $lengthException->GetMessage(), $lengthException->GetCode() );
		} catch ( Exception $exception ) {
			//autre cas (mais pour nous invalide)
			throw new Exception( $exception->GetMessage(), $exception->GetCode() );
		}
		$req = $this->db->prepare( 'INSERT INTO assurance (nom,codePostal,email,ville,telephone,pays,typeAssurance,numAssurer,adresse1,adresse2) VALUES(:nom,:codePostal,:email,:ville,:telephone,:pays,:typeassurance,:numAssurer,:adresse1,:adresse2)' );
		$req->bindValue( 'nom', $oAssurance->getNom(), PDO::PARAM_STR );
		$req->bindValue( 'codePostal', $oAssurance->getCodePostal(), PDO::PARAM_STR );
		$req->bindValue( 'email', $oAssurance->getEmail(), PDO::PARAM_STR );
		$req->bindValue( 'ville', $oAssurance->getVille(), PDO::PARAM_STR );
		$req->bindValue( 'telephone', $oAssurance->getTelephone(), PDO::PARAM_STR );
		$req->bindValue( 'pays', $oAssurance->getPays(), PDO::PARAM_STR );
		$req->bindValue('typeassurance', ((is_null($oAssurance->getTypeassurance())) ? ' ' : $oAssurance->getTypeassurance()), PDO::PARAM_INT);
		$req->bindValue( 'numAssurer', $oAssurance->getNumAssurer(), PDO::PARAM_STR );
		$req->bindValue( 'adresse1', $oAssurance->getAdresse1(), PDO::PARAM_STR );
		$req->bindValue( 'adresse2', $oAssurance->getAdresse2(), PDO::PARAM_STR );


		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$oAssurance->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}

	}

	public function getAllAssurance() {

		$stmt = $this->db->query("SELECT * FROM assurance");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAssurance( $id ) {
		$stm = "SELECT * FROM assurance WHERE id=:id";
		//preparation == protection des donn?es ? venir
		$stmt = $this->db->prepare( $stm );
		//liaison des marqueur :toto aux donnees
		$stmt->bindValue( 'id', $id, PDO::PARAM_INT );
		//execution de la requete sur le serveur SQL
		$stmt->execute();

		return $stmt;
	}

	public function update( $data ) {
		echo '<pre>' . print_r( $data, true ) . '</pre>';

		echo '<br>[debug]SESSION';
		echo '<pre>' . print_r( $data, true ) . '</pre>';

		$req = $this->db->prepare( 'UPDATE assurance SET nom=:nom,codePostal=:codePostal,email=:email,ville=:ville,telephone=:telephone,pays=:pays,typeAssurance=:typeassurance,numAssurer=:numAssurer,adresse1=:adresse1,adresse2=:adresse2 WHERE id =:id' );
		$req->bindValue( 'id', $data->getId(), PDO::PARAM_INT );
		$req->bindValue( 'nom', $data->getNom(), PDO::PARAM_STR );
		$req->bindValue( 'codePostal', $data->getCodePostal(), PDO::PARAM_STR );
		$req->bindValue( 'email', $data->getEmail(), PDO::PARAM_STR );
		$req->bindValue( 'ville', $data->getVille(), PDO::PARAM_STR );
		$req->bindValue( 'telephone', $data->getTelephone(), PDO::PARAM_STR );
		$req->bindValue( 'pays', $data->getPays(), PDO::PARAM_STR );
		$req->bindValue( 'typeassurance', $data->getTypeassurance(), PDO::PARAM_STR );
		$req->bindValue( 'numAssurer', $data->getNumAssurer(), PDO::PARAM_STR );
		$req->bindValue( 'adresse1', $data->getAdresse1(), PDO::PARAM_STR );
		$req->bindValue( 'adresse2', $data->getAdresse2(), PDO::PARAM_STR );

		if ( ! $req->execute() ) {
			echo "<br>[debug] Erreur";
		}
	}

	public function delete( $id ) {
		// =>voir  getLivre(id) pour modele
		$req  = "DELETE FROM assurance WHERE id=:id";
		$stmt = $this->db->prepare( $req );
		$stmt->execute();
		if ( $stmt->rowCount() == 1 ) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}
	}
}