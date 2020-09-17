<?php

	class UserManager {

		private $db;

		public function __construct() {
			$conn = new Connexion();
			$this->db = $conn->db();
		}

		public function add(User $user) {
			$sth = $this->db->prepare("INSERT INTO
									   user
									   (pseudo,
									    email,
									    password,
									    admin)
									   VALUES(
									   :pseudo,
									   :email,
									   :password,
									   :admin)");
			$sth->bindValue(':pseudo', $user->getPseudo());
			$sth->bindValue(':email', $user->getEmail());
			$sth->bindValue(':password', $user->getPassword());
			$sth->bindValue(':admin', $user->getAdmin(), PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function update(User $user) {
			$sth = $this->db->prepare("UPDATE
								       user
								       SET
								       pseudo = :pseudo,
								       email = :email,
								       password = :password,
								       admin = :admin
								       WHERE
								       id = :id");
			$sth->bindValue(':pseudo', $user->getPseudo());
			$sth->bindValue(':email', $user->getEmail());
			$sth->bindValue(':password', $user->getPassword());
			$sth->bindValue(':admin', $user->getAdmin(), PDO::PARAM_INT);
			$sth->bindValue(':id', $user->getId(), PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteByID($id) {
			$sth = $this->db->prepare("DELETE FROM
									   user
								 	   WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function getUserById($id) {
			$sth = $this->db->prepare("SELECT * FROM user WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			return new User($sth->fetch(PDO::FETCH_ASSOC));
		}

		public function getUsers() {
			$sth = $this->db->query("SELECT * FROM user");
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}