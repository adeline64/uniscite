<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 11/11/2018
 * Time: 17:56
 */

class ManagerVolontaire extends Manager {
    
    public function __construct($mode='prod'){
        parent::__construct($mode);
    }




	public function read($id){
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req = $this->db->prepare('SELECT * FROM volontaire WHERE id=:id');
		$req->bindValue('$id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$volontaire = new volontaire($array);

		return $volontaire;
	}

	public function add( $data ) {
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		//bloc try/catch pour gérer les exceptions
		//provenant de Client
		try {
			$volontaire = new volontaire($data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
		$req = $this->db->prepare('INSERT INTO volontaire (pre_inscrit,nom,prenom,adresse1,adresse2,codePostal,ville,pays,email,telephone,handicap,permis) VALUES(:pre_inscrit,:nom,:prenom,:adresse1,:adresse2,:codePostal,:ville,:pays,:email,:telephone,:handicap,:permis)');
		$req->bindValue('pre_inscrit', $volontaire->getPre_inscrit(), PDO::PARAM_STR);
		$req->bindValue('nom', $volontaire->getNom(), PDO::PARAM_STR);
		$req->bindValue('prenom', $volontaire->getPrenom(), PDO::PARAM_STR);
		$req->bindValue('adresse1', $volontaire->getAdresse1(), PDO::PARAM_STR);
		$req->bindValue('adresse2', $volontaire->getAdresse2(), PDO::PARAM_STR);
		$req->bindValue('codePostal', $volontaire->getCodePostal(), PDO::PARAM_STR);
		$req->bindValue('ville', $volontaire->getVille(), PDO::PARAM_STR);
		$req->bindValue('pays', $volontaire->getPays(), PDO::PARAM_STR);
		$req->bindValue('email', $volontaire->getEmail(), PDO::PARAM_STR);
		$req->bindValue('telephone', $volontaire->getTelephone(), PDO::PARAM_STR);
		$req->bindValue('handicap', ((is_null($volontaire->getHandicap())) ? ' ' : $volontaire->getHandicap()), PDO::PARAM_STR);
		$req->bindValue('permis', $volontaire->getPermis(), PDO::PARAM_STR);


		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$volontaire->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}
	}

	public function getAllVolontaire() {

		$stmt = $this->db->query("SELECT * FROM volontaire");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getVolontaire( $id ) {
		$stm = "SELECT * FROM volontaire WHERE id=:id";
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

		$req = $this->db->prepare('UPDATE volontaire SET nom=:nom,prenom=:prenom,adresse1=:adresse1,adresse2=:adresse2,codePostal=:codePostal,ville=:ville,pays=:pays,email=:email, telephone=:telephone, handicap=:handicap, permis=:permis,pre_inscrit=:pre_inscrit WHERE id = :id');
		$req->bindValue( 'id', $data->getId(), PDO::PARAM_INT );
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
		$req->bindValue('pre_inscrit', $data->getPre_inscrit(), PDO::PARAM_STR);
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}
	}

    public function getListe() {
        echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
        $req = $this->db->query('SELECT * FROM volontaire'); // 1 � N lignes
        
        //init tableau des volontaires
        $aVolontaires = array();
        
        //Parcours des N lignes trouv�es dans la table Volontaire
        while ($dataVolontaire = $req->fetch()) {
            //on stocke un volontaire par case du tableau
            $aVolontaires[] = new Volontaire($dataVolontaire);
        }
        
        //on retourne le tableau        
        return $aVolontaires;
    }

	public function delete( $id ) {
		// =>voir  getLivre(id) pour modele
		$req  = "DELETE FROM volontaire WHERE id=:id";
		$stmt = $this->db->prepare( $req );
		$stmt->execute();
		if ( $stmt->rowCount() == 1 ) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}

	}


}