<?php


class Employe extends Personne{


	/**
	 * Created by PhpStorm.
	 * User: Adeline
	 * Date: 24/01/2019
	 * Time: 20:47
	 */


	protected $id;
	protected $password;

	public function __construct( array $data = [] ) {
		//appel du constructeur parent puisqu'on est hérité de ...
		parent::__construct( $data );
	}


	public function getId() {
		return $this->id;
	}


	public function getPassword() {
		return $this->password;
	}


	public function setId( $id ) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		$id = (int) $id;
		if ( $id > 0 ) {
			$this->id_employe = $id;
		}
	}


	public function setPassword( $password ) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		if ( strlen( trim( $password ) ) == 0 ) {
			//Si le mot de passe est vide
			throw new Exception( "le mot de passe est obligatoire" );
		}

		if ( strlen( $password ) > strlen( trim( $password ) ) ) {
			//si le mot de passe commence/fini (ou les 2) par <espace>
			throw new Exception( "Le mot de passe ne peut pas commencer et se finir par un espace" );
		}

		if ( strlen( trim( $password ) ) < 6 ) {
			//Si le mot de passe est inf 6 car
			throw new Exception( "Le mot de passe doit avoir plus de 6 caractères" );
		}

// 		if (preg_match('/[0-9]{2}/',$password))
// 		{
// 			//il faut 2 chiffres dans le mot de passe
// 			throw new Exception( "Le mot de passe ne doit pas avoir plus de 2 chiffres" );
// 		}

// 		if(preg_match('/[A-Za-z][0-9]+[A-Za-z]/',$password))
// 		{
// 			throw new Exception( "Le mot de passe doit avoir au mois 1 chiffres." );
// 		}

		/*
		 TOUT VA BIEN
        */
		$this->password = $password;
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