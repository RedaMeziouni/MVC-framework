<?php 

class User {

	// Instantiate DB conn
	private $db;

	// User constructor
	public function __construct(){
		$this->db = new Database;
	}

}