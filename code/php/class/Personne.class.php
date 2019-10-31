<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 30/01/2019
 * Time: 19:29
 */

class Personne {

	protected $id;
	protected $nom;
	protected $prenom;
	protected $adresse1;
	protected $adresse2;
	protected $codePostal;
	protected $email;
	protected $ville;
	protected $telephone;
	protected $pays;
	protected $handicap;
	protected $permis;

	public function __construct( array $data =[] ) {
	    if (!empty($data)) {
	        $this->hydrate($data);
	    } else {
	        throw new Exception("Aucune donnees");
	    }
	}

	public function getId() {
		return $this->id;
	}


	public function getNom() {
		return $this->nom;
	}

	/**
	 * @return mixed
	 */
	public function getPrenom() {
		return $this->prenom;
	}

	/**
	 * @return mixed
	 */
	public function getAdresse1() {
		return $this->adresse1;
	}

	/**
	 * @return mixed
	 */
	public function getAdresse2() {
		return $this->adresse2;
	}

	/**
	 * @return mixed
	 */
	public function getCodePostal() {
		return $this->codePostal;
	}

	/**
	 * @return mixed
	 */
	public function getVille() {
		return $this->ville;
	}

	/**
	 * @return mixed
	 */
	public function getPays() {
		return $this->pays;
	}

	/**
	 * @return mixed
	 */
	public function gethandicap() {
		return $this->handicap;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return mixed
	 */
	public function getTelephone() {
		return $this->telephone;
	}

	/**
	 * @return mixed
	 */
	public function getPermis() {
		return $this->permis;
	}



	/**
	 * @param mixed $id_personne
	 */
	public function setId( $id ){
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		}
	}


	public function setNom( $nom ) {
		if (strlen(trim($nom)) > 0)
			//strlen = Calcule la taille d'une cha�ne
			// trim = Supprime les espaces (ou d'autres caract�res) en d�but et fin de cha�ne
		{
			if (strpos($nom,"#") !== false)
				// strpos = Cherche la position de la premi�re occurrence dans une cha�ne
			{
				throw new Exception("Le nom ne peut pas avoir de caracteres speciaux");
			}
			if (preg_match("/[0-9]/", "$nom"))
				// preg_match = sert ici pour les cfiffres
			{
				throw new Exception("Le nom ne peut pas avoir de chiffre");
			}
			else
			{
				//echo "la cha�ne $nom est correcte";
				$this->nom = $nom;
			}
		}
	}


	public function setPrenom( $prenom ) {
		if (strlen(trim($prenom)) > 0)
		{
			if (strpos($prenom,"#") !== false)
			{
				throw new Exception("Le prenom ne peut pas avoir de caracteres speciaux");
			}

			if (preg_match("/[0-9]/", "$prenom"))
			{
				throw new Exception("Le prenom ne peut pas avoir de chiffre");
			}

			else
			{
				//echo "la cha�ne $prenom est correcte";
				$this->prenom = $prenom;
			}
		}
	}

	/**
	 * @param mixed $adresse1
	 */
	public function setAdresse1( $adresse1 ) {
		if (strlen(trim($adresse1)) > 0)
		{
			$this->adresse1 = $adresse1;
		}else{
			echo "l'adresse est obligatoire";
		}
	}

	/**
	 * @param mixed $adresse2
	 */
	public function setAdresse2( $adresse2 ) {
		if (strlen(trim($adresse2)) > 0)
		{
			$this->adresse2 = $adresse2;
		}
	}//pas de else

	/**
	 * @param mixed $codePostal
	 */
	public function setCodePostal( $codePostal ) {
		if (preg_match('/[0-9]{5}/',$codePostal))
		{
			$this->codePostal = $codePostal;
		} else {
			echo "<br/>Aucun r&eacute;sultat n'a &eacute;t&eacute; trouv&eacute;.";
		}
	}

	public function setVille( $ville ) {
		if (strlen(trim($ville)) > 0)
		{
			$this->ville = $ville;

			if (preg_match("/[0-9]/", "$ville"))
			{
				throw new Exception("La ville ne peut pas avoir de chiffre");
			}

		}else{
			echo "la ville est obligatoire";
		}
	}

	/**
	 * @param mixed $pays
	 */
	public function setPays( $pays ) {
		if (strlen(trim($pays)) > 0)
		{
			$this->pays = $pays;

			if (preg_match("/[0-9]/", "$pays"))
			{
				throw new Exception("La ville ne peut pas avoir de chiffre");
			}

		}else{
			echo "le pays est obligatoire";
		}
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail( $email ) {
		//1) si la chaine n'est pas vide
		if (strlen(trim($email)) == 0) {
			//erreur
			throw new LengthException("Le mail est vide",100); //code 100 == mail vide
		} else {
			//pas d'erreur on continue
// 			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 				//mail valid�
				$this->email = $email;
// 			} else {
// 				//erreur � g�rer
// 				throw new Exception("Le mail est invalide",101); //code 101 == mail invalide
// 			}
		}
	}

	/**
	 * @param mixed $telephone
	 */
	public function setTelephone( $telephone ) {
		$this->telephone = $telephone;
	}

	/**
	 * @param mixed $handicap
	 */
	public function setHandicap( $handicap ) {
		$this->handicap = $handicap;
	}

	/**
	 * @param mixed $permis
	 */
	public function setPermis( $permis ) {
		$this->permis = $permis;
	}


	
	
	protected function hydrate($array){
	    echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
	    foreach ($array as $key => $value) {
	        $methodName = 'set'.ucfirst($key);
	        if(method_exists($this, $methodName)){
	            $this->$methodName($value);
	        }
	    }
	}

}