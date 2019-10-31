<?php


class possede {

	protected $id;
	protected $vehicule;
	protected $employe;
	protected $volontaire;

	public function __construct( array $array =[] )
	{
		$this->hydrate($array);
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getVehicule() {
		return $this->vehicule;
	}

	/**
	 * @return mixed
	 */
	public function getEmploye() {
		return $this->employe;
	}

	/**
	 * @return mixed
	 */
	public function getVolontaire() {
		return $this->volontaire;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @param mixed $vehicule
	 */
	public function setVehicule( $vehicule ) {
		$this->vehicule = $vehicule;
	}

	/**
	 * @param mixed $employe
	 */
	public function setEmploye( $employe ) {
		$this->employe = $employe;
	}

	/**
	 * @param mixed $volontaire
	 */
	public function setVolontaire( $volontaire ) {
		$this->volontaire = $volontaire;
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