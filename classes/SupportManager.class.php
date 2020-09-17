<?php

	class SupportManager {

		private $db;

		public function __construct() {
			$conn = new Connexion();
			$this->db = $conn->db();
		}

		public function add(Support $support) {
			$sth = $this->db->prepare("INSERT INTO support(name) VALUES(:name)");
			$sth->bindValue(':name', $support->getName());
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function update(Support $support) {
			$sth = $this->db->prepare("UPDATE support SET name = :name WHERE id = :id");
			$sth->bindValue(':name', $support->getName());
			$sth->bindValue(':id', $support->getId(), PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteById($id) {
			$sth = $this->db->prepare("DELETE FROM
									   support
								 	   WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function getSupportById($id) {
			$sth = $this->db->prepare("SELECT * FROM support WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return new Support($sth->fetch(PDO::FETCH_ASSOC));
		}

		public function getSupports() {
			$sth = $this->db->query("SELECT * FROM support");
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}