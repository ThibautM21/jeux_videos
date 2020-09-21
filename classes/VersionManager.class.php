<?php

	class VersionManager {

		private $db;

		public function __construct() {
			$conn = new Connexion();
			$this->db = $conn->db();
		}

		public function add(Version $version) {
			$sth = $this->db->prepare("INSERT INTO version(game_id, support_id, release_date) VALUES(:game_id, :support_id, :release_date)");
			$sth->bindValue(':game_id', $version->getGame_id());
			$sth->bindValue(':support_id', $version->getSupport_id());
			$sth->bindValue(':release_date', $version->getRelease_date());
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function update(Version $version) {
			$sth = $this->db->prepare("UPDATE version SET game_id = :game_id, support_id = :support_id, release_date = :release_date WHERE id = :id");
			$sth->bindValue(':game_id', $version->getGame_id());
			$sth->bindValue(':support_id', $version->getSupport_id());
			$sth->bindValue(':release_date', $version->getRelease_date());
			$sth->bindValue(':id', $version->getId());
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteById($id) {
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
									   version
								 	   WHERE support_id = :support_id");
			$sth->bindValue(':support_id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteByGameId($id) {
			$sth = $this->db->prepare("DELETE FROM
									   version
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
			return new Version($sth->fetch(PDO::FETCH_ASSOC));
		}

		public function getVersions() {
			$sth = $this->db->query("SELECT version.id, title, name, release_date FROM version JOIN game ON game_id = game.id JOIN support ON support_id = support.id");
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getFullVersions() {
			$sth = $this->db->query("SELECT
								    version.id,
								    title,
								    description,
								    editor.name as editor,
								    image,
								    game.link,
								    pegi,
								    support.name as support,
								    release_date,
								    category.type
								FROM
								    version
								JOIN game ON game_id = game.id
								JOIN support ON support_id = support.id
								JOIN editor ON game.editor_id = editor.id
								JOIN category ON category.id = game.category_id");
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}