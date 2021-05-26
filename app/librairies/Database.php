<?php

class Database {

	// Default values
	private $dbHost = DB_HOST;
	private $dbUser = DB_USER;
	private $dbPass = DB_PASS;
	private $dbName = DB_NAME;

	// Setting values
	private $statement; //prepapre a statement
	private $dbHandler; 
	private $error;

	// Constructor
	public function __construct() {
		// Run our Connection whene ever we call the DB file
		$conn = 'mysql:host=' .$this->dbHost. ';dbname=' .$this->dbName;

		$options = array (
			//Preventing driver crashing and timeout - conn already exist
			PDO::ATTR_PERSISTENT => true,
			// Handle Errors
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		try {
			$this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
			// echoing the error
			echo $this->error;

		}
	}

	// Methods Allows us to write Queries
	public function query($sql) {
		$this->statement = $this->dbHandler->prepapre($sql);
	}

	// Bind Values
	public function bind($parameter, $value, $type = null) {
		switch (is_null($type)) {
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
		}
		$this->statement->bindValue($parameter, $value, $type);
	}

	// Execute the prepared statement
	public function execute() {
		return $this->statement->execute();
	}

	// Return an array
	public function resultSet() {
		$this-execute();
		return $this->statement->fetchAll(PDO::FETCH_OBJ);
	}

	// return a single row as an Object
	public function single() {
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_OBJ);
	}

	// Get the rowCount 
	public function rowCount() {
		return $this->statement->rowCount(); //count the rows that are changed or affected by a query
	}
}