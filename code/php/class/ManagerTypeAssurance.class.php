<?php


class ManagerTypeAssurance extends ManagerAssurance {

	public function __construct( $mode = 'prod' ) {
		debug( '<br>[debug]Dans "' . __CLASS__ . "::" . __FUNCTION__ . '" [/debug]', true );
		parent::__construct( $mode );
	}

	public function read( $id ) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		$req = $this->db->prepare( 'SELECT * FROM typeassurance WHERE id =:id' );
		$req->bindValue( 'id', $id, PDO::PARAM_INT );
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$oTypeAssurance = new typeassurance( $array );

		return $oTypeAssurance;
	}

	public function add( $data ) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		//bloc try/catch pour g?rer les exceptions
		//provenant de Employer
		try {
			$oTypeAssurance = new typeassurance( $data );
		} catch ( LengthException $lengthException ) {
			//cas longueur == 0
			throw new Exception( $lengthException->GetMessage(), $lengthException->GetCode() );
		} catch ( Exception $exception ) {
			//autre cas (mais pour nous invalide)
			throw new Exception( $exception->GetMessage(), $exception->GetCode() );
		}
		$req = $this->db->prepare( 'INSERT INTO typeassurance (numero,nom) VALUES(:numero,:nom)' );
		$req->bindValue( 'numero', $oTypeAssurance->getNumero(), PDO::PARAM_STR );
		$req->bindValue( 'nom', $oTypeAssurance->getNom(), PDO::PARAM_STR );

		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$oTypeAssurance->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}
	}

	public function getAllTypeAssurance() {

		$stmt = $this->db->query("SELECT * FROM typeassurance");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getTypeAssurance( $id ) {
		$stm = "SELECT * FROM typeassurance WHERE id=:id";
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

		$req = $this->db->prepare( 'UPDATE typeassurance SET numero=:numero,nom=:nom WHERE id =:id' );
		$req->bindValue( 'id', $data->getId(), PDO::PARAM_INT );
		$req->bindValue( 'numero', $data->getNumero(), PDO::PARAM_STR );
		$req->bindValue( 'nom', $data->getNom(), PDO::PARAM_STR );

		if ( ! $req->execute() ) {
			echo "<br>[debug] Erreur";
		}
	}

	public function delete( $id ) {
		// =>voir  getLivre(id) pour modele
		$req  = "DELETE FROM typeassurance WHERE id=:id";
		$stmt = $this->db->prepare( $req );
		$stmt->execute();
		if ( $stmt->rowCount() == 1 ) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}
	}

}