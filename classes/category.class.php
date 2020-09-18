<?php

class Category {

	private $id;
	private $type;

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
	public function getType() {return $this->type;}

	// Setter
	private function setId($id) {
		if (is_int($id) && strlen($id)<=999){
			$this->id = $id;
		}
		else{
			echo "Je sais pas.";
		}		
	}

	public function setType($type) {
		if (is_string($type) && strlen($type)<=50){
		$this->type = $type;
		}
		else{
			echo "La catégorie n'est pas bonne.";
		}

		
	}
}