<?php

class support{	


	private $id;
	private $name;


// Constucteur
	public function __construct(array $donnees){
		foreach ($donnees as $key => $value) {
			$method='set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}			
		}
	}

// Getter
	public function getId(){return $this->id;}
	public function getName(){return $this->name;}


// Setter
	private function setId($id){
		$this->id=$id;
	}

	public function setName($name){
		$this->name=$name;
	}	

}