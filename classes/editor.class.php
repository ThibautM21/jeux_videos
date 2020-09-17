<?php

class Editor {

	private $id;
	private $name;
	private $link;

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
	public function getLink() {return $this->link;}

	// Setter
	private function setId($id) {
		$this->id = $id;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function setLink($link) {
		$this->link = $link;
	}
}