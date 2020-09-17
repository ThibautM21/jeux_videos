<?php

class User {

	private $id;
	private $pseudo;
	private $email;
	private $password;
	private $admin;

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
	public function getPseudo() {return $this->pseudo;}
	public function getEmail() {return $this->email;}
	public function getPassword() {return $this->password;}
	public function getAdmin() {return $this->admin;}

	// Setter
	private function setId($id) {
		$this->id = $id;
	}

	public function setPseudo($pseudo) {
		$this->pseudo = $pseudo;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function setAdmin($admin) {
		$this->admin = $admin;
	}
}