<?php

class Pokemon {
	private $id;
	private $database;
	private $pokemon;
	private $statistics;
	private $abilities;
	
	public function __construct($pokeid, $db) {
		$this->id = $pokeid;
		$this->database = $db;

		$this->findPokemon();
		$this->findStatistics();
		$this->findAbilities();
	}

	public function findPokemon() {
		$params = array(
			'id' => $this->id
		);

		$sql = file_get_contents('sql/getpokemon.sql');
		$statement = $this->database->prepare($sql);
		$statement->execute($params);
		$pokemon = $statement->fetchAll(PDO::FETCH_ASSOC);
		$this->pokemon = $pokemon[0];
	}

	public function findStatistics() {
		$params = array(
			'id' => $this->id
		);

		$sql = file_get_contents('sql/getstatistics.sql');
		$statement = $this->database->prepare($sql);
		$statement->execute($params);
		$this->statistics = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function findAbilities() {
		$params = array(
			'id' => $this->id
		);

		$sql = file_get_contents('sql/getabilities.sql');
		$statement = $this->database->prepare($sql);
		$statement->execute($params);
		$this->abilities = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getnewid() {
		$params = array(
			'id' => $this->id
		);

		$sql = file_get_contents('sql/userpokemonid.sql');
		$statement = $this->database->prepare($sql);
		$statement->execute();
		$newid = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $newid[0];
	}

	public function getPokemon() {
		return $this->pokemon;
	}

	public function getStatistics() {
		return $this->statistics;
	}

	public function getAbilities() {
		return $this->abilities;
	}
}

?>