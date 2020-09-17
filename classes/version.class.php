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
	public function getRelease_id() {return $this->release_date;}

	// Setter
	private function setId($id) {
		$this->id = $id;
	}

	public function setGame_id($game_id) {
		$this->game_id = $game_id;
	}

	public function setSupport_id($support_id) {
		$this->support_id = $support_id;
	}

	public function setRelease_id($release_date) {
		$this->release_date = $release_date;
	}
}