<?php

class Version {

	private $id;
	private $game_id;
	private $support_id;
	private $release_date;

	// Constucteur
	public function __construct(array $donnees) {
		foreach ($donnees as $key => $value) {
			$method='set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	// Getter
	public function getId() {return $this->id;}
	public function getGame_id() {return $this->game_id;}
	public function getSupport_id() {return $this->support_id;}
	public function getRelease_date() {return $this->release_date;}

	// Setter
	private function setId($id) {
		if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0){
			$this->id = $id;
		} else {
			echo "Je sais pas.";
		}
	}

	public function setGame_id($game_id) {
		if (filter_var($game_id, FILTER_VALIDATE_INT) && $game_id > 0){
			$this->game_id = $game_id;
		} else {
			echo "Invalid game ID.";
		}
	}

	public function setSupport_id($support_id) {
		if (filter_var($support_id, FILTER_VALIDATE_INT) && $support_id > 0){
			$this->support_id = $support_id;
		} else {
			echo "Nope.";
		}
	}

	public function setRelease_date($release_date) {
		$d = DateTime::createFromFormat('Y-m-d', $release_date);
		if ($d && $d->format('Y-m-d') === $release_date);
		$this->release_date = $release_date;
	}
}