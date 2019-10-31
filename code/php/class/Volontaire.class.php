<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 11/11/2018
 * Time: 17:54
 */

class Volontaire extends Personne {

	protected $id;
	protected $pre_inscrit;

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
	public function getPre_inscrit()
	{
	    return $this->pre_inscrit;
	}
	
	/**
	 * @param mixed $pre_inscrit
	 */
	public function setPre_inscrit($pre_inscrit)
	{
	    $this->pre_inscrit = $pre_inscrit;
	}

	public function setId( $id ){
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		} else {
		    throw new Exception("Un identifiant est un entier");
		}
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