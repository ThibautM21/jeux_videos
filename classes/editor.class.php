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
		if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
			$this->id = $id;
		} else {
			echo "Je sais pas.";
		}
	}

	public function setName($name) {
		if (is_string($name) && strlen($name) <= 100) {
			$this->name = $name;
		} else {
			echo "L'éditeur n'est pas bon.";
		}
	}

	public function setLink($link) {
		if (is_string($link) && strlen($link) <= 255) {
			$this->link = $link;
		} else {
			echo "Le lien ne fonctionne pas.";
		}
	}
}