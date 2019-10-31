<?php


class reunion {

	protected $id;
	protected $date;

	public function __construct( array $data =[] ) {
		if (!empty($data)) {
			$this->hydrate($data);
		} else {
			throw new Exception("Aucune donnees");
		}
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
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @param mixed $date
	 */
	public function setDate( $date ) {
		$this->date = $date;
	}

	protected function hydrate( $array ) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		foreach ( $array as $key => $value ) {
			$methodName = 'set' . ucfirst( $key );
			if ( method_exists( $this, $methodName ) ) {
				$this->$methodName( $value );
			}
		}
	}

}