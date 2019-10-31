<?php


class Assure {

	protected $id;
	protected $assurance;
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
	public function getAssurance() {
		return $this->assurance;
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
	public function setId( $id ): void {
		$this->id = $id;
	}

	/**
	 * @param mixed $assurance
	 */
	public function setAssurance( $assurance ): void {
		$this->assurance = $assurance;
	}

	/**
	 * @param mixed $employe
	 */
	public function setEmploye( $employe ): void {
		$this->employe = $employe;
	}

	/**
	 * @param mixed $volontaire
	 */
	public function setVolontaire( $volontaire ): void {
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