<?php


class typeAssurance {

	protected $id;
	protected $numero;
	protected $nom;

	public function __construct( array $array =[] )
	{
		$this->hydrate($array);
	}

	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getNumero() {
		return $this->numero;
	}


	public function getNom() {
		return $this->nom;
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

	/**
	 * @param mixed $numero
	 */
	public function setNumero( $numero ) {
		$this->numero = $numero;
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