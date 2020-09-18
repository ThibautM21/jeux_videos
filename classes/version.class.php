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
		if (is_int($id) && strlen($id)<=999){
			$this->id = $id;
		}
		else{
			echo "Je sais pas.";
		}		
	}

	public function setGame_id($game_id) {
		f (is_int($game_id) && $game_id >0){
			$this->game_id = $game_id;
		}
		else{
			echo "Nope.";
		}
		
	}

	public function setSupport_id($support_id) {
		f (is_int($support_id) && $support_id >0){
			$this->support_id = $support_id;
		}
		else{
			echo "Nope.";
		}
		
	}

	public function setRelease_id($release_date) {
		f (is_int($release_date) && $release_date >0){
			$this->release_date = $release_date;
		}
		else{
			echo "Nope.";
		}
		
	}
}