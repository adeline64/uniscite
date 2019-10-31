<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 16/02/2019
 * Time: 00:33
 */

class Assurance {

	protected $id;
	protected $nom;
	protected $codePostal;
	protected $email;
	protected $ville;
	protected $telephone;
	protected $pays;
	protected $typeassurance;
	protected $numAssurer;
	protected $adresse1;
	protected $adresse2;

	public function __construct( array $array =[] )
	{
		$this->hydrate($array);
	}


	public function getId() {
		return $this->id;
	}


	public function getNom() {
		return $this->nom;
	}


	public function getCodePostal() {
		return $this->codePostal;
	}


	public function getEmail() {
		return $this->email;
	}


	public function getVille() {
		return $this->ville;
	}


	public function getTelephone() {
		return $this->telephone;
	}


	public function getPays() {
		return $this->pays;
	}

	/**
	 * @return mixed
	 */
	public function getTypeassurance() {
		return $this->typeassurance;
	}

	/**
	 * @return mixed
	 */
	public function getNumAssurer() {
		return $this->numAssurer;
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




	public function setId( $id ) {
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		}
	}


	public function setNom( $nom ) {
		if (strlen(trim($nom)) > 0)
			//strlen = Calcule la taille d'une chaîne
			// trim = Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
		{
			if (strpos($nom,"#") !== false)
				// strpos = Cherche la position de la première occurrence dans une chaîne
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
				//echo "la chaîne $nom est correcte";
				$this->nom = $nom;
			}
		}

	}


	public function setCodePostal( $codePostal ) {
		if (preg_match('/[0-9]{5}/',$codePostal))
		{
			$this->codePostal = $codePostal;
		} else {
			echo "<br/>Aucun r&eacute;sultat n'a &eacute;t&eacute; trouv&eacute;.";
		}
	}


	public function setEmail( $email ) {
		//1) si la chaine n'est pas vide
		if (strlen(trim($email)) == 0) {
			//erreur
			throw new LengthException("Le mail est vide",100); //code 100 == mail vide
		} else {
			//pas d'erreur on continue
// 			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 				//mail validé
			$this->email = $email;
// 			} else {
// 				//erreur à gérer
// 				throw new Exception("Le mail est invalide",101); //code 101 == mail invalide
// 			}
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


	public function setTelephone( $telephone ) {
		$this->telephone = $telephone;
	}

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
	 * @param mixed $typeassurance
	 */
	public function setTypeassurance( $typeassurance ) {
		$this->typeassurance = $typeassurance;
	}

	/**
	 * @param mixed $numAssurer
	 */
	public function setNumAssurer( $numAssurer ) {
		$this->numAssurer = $numAssurer;
	}

	/**
	 * @param mixed $adresse1
	 */
	public function setAdresse1( $adresse1 ) {
		$this->adresse1 = $adresse1;
	}

	/**
	 * @param mixed $adresse2
	 */
	public function setAdresse2( $adresse2 ) {
		$this->adresse2 = $adresse2;
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