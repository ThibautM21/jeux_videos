<?php

class Game {

	private $id;
	private $title;
	private $description;
	private $image;
	private $link;
	private $pegi;
	private $category_id;
	private $editor_id;

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
	public function getTitle() {return $this->title;}
	public function getDescription() {return $this->description;}
	public function getImage() {return $this->image;}
	public function getLink() {return $this->link;}
	public function getPegi() {return $this->pegi;}
	public function getCategory_id() {return $this->category_id;}
	public function getEditor_id() {return $this->editor_id;}

	// Setter
	private function setId($id) {
		if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
			$this->id = $id;
		} else {
			echo "Je sais pas.";
		}
	}

	public function setTitle($title) {
		if (is_string($title) && strlen($title) <= 100) {
			$this->title = $title;
		} else {
			echo "Manque d'immagination -_-.";
		}
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setImage($image) {
		if (is_string($image) && strlen($image) <= 255) {
			$this->image = $image;
		} else {
		echo "Ah t'as merdé.";
		}
	}

	public function setLink($link) {
		if (is_string($link) && strlen($link) <= 255) {
			$this->link = $link;
		} else{
			echo "Le lien ne fonctionne pas.";
		}
	}

	public function setPegi($pegi) {
		if (filter_var($pegi, FILTER_VALIDATE_INT) && $pegi > 0) {
			$this->pegi = $pegi;
		} else {
			echo "Oskuuuur.";
		}
	}

	public function setCategory_id($category_id) {
		if (filter_var($category_id, FILTER_VALIDATE_INT) && $category_id > 0) {
			$this->category_id = $category_id;
		} else {
			echo "Nope.";
		}
	}

	public function setEditor_id($editor_id) {
		if (filter_var($editor_id, FILTER_VALIDATE_INT) && $editor_id > 0) {
			$this->editor_id = $editor_id;
		} else {
			echo "Nope.";
		}
	}
}