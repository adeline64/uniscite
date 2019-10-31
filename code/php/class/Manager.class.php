<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 28/02/2019
 * Time: 22:55
 */

class Manager {

	protected $db;
	protected $mode;

	public function __construct($mode='prod') {
		$this->mode=$mode;
	}

	public function setDb($db) {
		$this->db = $db;
	}

	public function add($data) {


	}

	public function read($id) {

	}

	public function update($data) {

	}

	/**
	 * Fonctione de suppression d'information d'une table à partir d'une id
	 * de table
	 * @param unknown $id
	 */
	public function delete($id) {

	}
}