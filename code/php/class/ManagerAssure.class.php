<?php
class ManagerAssure extends Manager {
    
    /**
     * Constructeur
     * @param string $mode
     */
    public function __construct( $mode = 'prod' ) {
        debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
        parent::__construct( $mode );
    }

	public function read($id){
		debug("ID DEMANDE: ");
		debug($id);
		$req = $this->db->prepare('SELECT * FROM assure WHERE id=:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		debug("assure from DB: ",true);
		debug($array,true);
		debug("End assure from DB: ",true);
		$assure = new assure($array);
		return $assure;
	}
    
    /**
     * Fonction d'ajout d'une donnée dans la table 'assure'
     * {@inheritDoc}
     * @see Manager::add()
     */
    public function addAssuranceEmploye($idemploye=0,$idassurance=0) {
        debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
        if (is_null($this->db)) {
            throw new Exception("PAS DE CONNEXION A LA BASE");
        }
        if ($idemploye == 0 && $idassurance ==0) {
            throw new Exception("PAS DE DONNEE A TRAITER");
        }
        $req = "INSERT INTO assure(employe,assurance) VALUES (:employe,:assurance)";
        $stmt = $this->db->prepare($req);
        $stmt->bindValue('employe',$idemploye);
        $stmt->bindValue('assurance',$idassurance);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            debug('<br>[debug]OK 1 ligne Ajoutee');
        } else {
            debug('<br>Erreur suppression donnees');
            throw new Exception("Erreur de Ajout ".__CLASS__." (idemploye: ".$idemploye.", idassurance: ".$idassurance.")");
        }
    }
    
    /**
     * Fonction d'ajout d'une donnée dans la table 'assure'
     * {@inheritDoc}
     * @see Manager::add()
     */
    public function addAssuranceVolontaire($idvolontaire=0,$idassurance=0) {
        debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
        if (is_null($this->db)) {
            throw new Exception("PAS DE CONNEXION A LA BASE");
        }
        if ($idvolontaire == 0 && $idassurance ==0) {
            throw new Exception("PAS DE DONNEE A TRAITER");
        }
        $req = "INSERT INTO assure(volontaire,assurance) VALUES (:volontaire,:assurance)";
        $stmt = $this->db->prepare($req);
        $stmt->bindValue('volontaire',$idvolontaire);
        $stmt->bindValue('assurance',$idassurance);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            debug('<br>[debug]OK 1 ligne Ajoutee');
        } else {
            debug('<br>Erreur suppression donnees');
            throw new Exception("Erreur de Ajout ".__CLASS__." (idvolontaire: ".$idvolontaire.", idassurance: ".$idassurance.")");
        }
    }

	public function getAllAssure() {
		$stmt = $this->db->query("SELECT * FROM assure");

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAssure($id) {
		$stm = "SELECT * FROM assure WHERE id=:id";
		//preparation == protection des donn?es ? venir
		$stmt = $this->db->prepare($stm);
		//liaison des marqueur :toto aux donnees
		$stmt->bindValue('id',$id,PDO::PARAM_INT);
		//execution de la requete sur le serveur SQL
		$stmt->execute();
		return $stmt;
	}
    
    /**
     * Fonction de modification d'une ligne dans la table
     * {@inheritDoc}
     * @see Manager::update()
     */
    public function update($id=0,$idemploye=0,$idvolontaire=0,$idassurance=0) {
        debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
        if (is_null($this->db)) {
            throw new Exception("PAS DE CONNEXION A LA BASE");
        }
        if ($id == 0 && $idemploye == 0 && $idvolontaire == 0 && $idassurance ==0) {
            throw new Exception("PAS DE DONNEE A TRAITER");
        }
        $req = "UPDATE assure SET employe=:employe, volontaire=:volontaire,assurance=:assurance WHERE id=:id";
        $stmt = $this->db->prepare($req);
        $stmt->bindValue('employe',$idemploye);
        $stmt->bindValue('volontaire',$idvolontaire);
        $stmt->bindValue('assurance',$idassurance);
        $stmt->bindValue('id',$id);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            debug('<br>[debug]OK 1 ligne modifiee');
        } else {
            debug('<br>Erreur suppression donnees');
            throw new Exception("Erreur de modification ".__CLASS__." (id: ".$id.", idemploye: ".$idemploye.", idvolontaire: ".$idvolontaire.", idassurance: ".$idassurance.")");
        }
    }
    
    /**
     * Fonction de suppression d'une ddonnée dans la table 'assure' 
     * à partir de son identifiant de table
     * {@inheritDoc}
     * @see Manager::delete()
     */
    public function delete($id) {
        debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
        if (is_null($this->db)) {
            throw new Exception("PAS DE CONNEXION A LA BASE");
        }
        $req = "DELETE FROM assure WHERE id=:id";
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