<?php

class Game {

	private $id;
	private $title;
	private $description;
	private $image;
	private $link;
	private $pegi;
	private $category_id;
	private $editor_id

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
		$this->id = $id;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setImage($image) {
		$this->image = $image;
	}

	public function setLink($link) {
		$this->link = $link;
	}

	public function setPegi($pegi) {
		$this->pegi = $pegi;
	}

	public function setCategory_id($category_id) {
		$this->category_id = $category_id;
	}

	public function setEditor_id($editor_id) {
		$this->editor_id = $editor_id;
	}
}