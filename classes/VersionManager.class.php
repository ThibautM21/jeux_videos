<?php

	class VersionManager {

		private $db;

		public function __construct() {
			$conn = new Connexion();
			$this->db = $conn->db();
		}

		public function add(Version $version) {
			$sth = $this->db->prepare("INSERT INTO version(game_id, support_id, release_date) VALUES(:game_id, :support_id, :release_date)");
			$sth->bindValue(':game_id', $version->game_id());
			$sth->bindValue(':support_id', $version->support_id());
			$sth->bindValue(':release_date', $version->release_date());
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function update(Version $version) {
			$sth = $this->db->prepare("UPDATE version SET game_id = :game_id, support_id = :support_id, release_date = :release_date WHERE id = :id");
			$sth->bindValue(':game_id', $version->game_id());
			$sth->bindValue(':support_id', $version->support_id());
			$sth->bindValue(':release_date', $version->release_date());
			$sth->bindValue(':id', $version->id());
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteByID($id) {
			$sth = $this->db->prepare("DELETE FROM
									   version
								 	   WHERE id = :id");
			$sth->bindValue(':id', $id);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteBySupportId($id) {
			$sth = $this->db->prepare("DELETE FROM
									   support
								 	   WHERE support_id = :support_id");
			$sth->bindValue(':support_id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteByGameId($id) {
			$sth = $this->db->prepare("DELETE FROM
									   support
								 	   WHERE game_id = :game_id");
			$sth->bindValue(':game_id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function getVersionById($id) {
			$sth = $this->db->prepare("SELECT * FROM version WHERE id = :id");
			$sth->bindValue(':id', $id);
			$sth->execute();
			$sth->closeCursor();
			return new Version($sth->fetch(PDO::FETCH_ASSOC));
		}

		public function getVersions() {
			$sth = $this->db->query("SELECT * FROM version");
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}