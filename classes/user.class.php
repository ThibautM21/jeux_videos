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
		if (is_string($pseudo) && strlen($pseudo)>=5 && strlen($pseudo)<=8){
		$this->pseudo = $pseudo;
		}
		else{
			echo "Le pseudo autorisé entre 5 et 8 caractères.";
		}
	}

	public function setEmail($email) {
		if (is_string($email) && strlen($email)<=255){
			$this->email = $email;
		}		
	else{
		echo "Ah t'as merdé.";
		}
		
	}

	public function setPassword($password) {
		if (is_string($password) && strlen($password)>=8 && strlen($password)<=255){
			$this->password = $password;
		}
		else{
			echo "Eh ouai, mais non.";
		}		
	}

	public function setAdmin($admin) {
		if (is_int($admin) && strlen($admin)<=999){
			$this->admin = $admin;
		}
		else{
			echo "Je sais pas.";
		}
		
	}
}