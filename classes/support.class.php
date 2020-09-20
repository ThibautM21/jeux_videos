<?php

class Support {

	private $id;
	private $name;

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
	public function getName() {return $this->name;}

	// Setter
	private function setId($id) {
		if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
			$this->id = $id;
		} else {
			echo "Je sais pas.";
		}
	}

	public function setName($name) {
		if (is_string($name) && strlen($name) <=100) {
			$this->name = $name;
		} else {
			echo "Support inconnue.";
		}
	}
}