<?php

	class EditorManager {

		private $db;

		public function __construct() {
			$conn = new Connexion();
			$this->db = $conn->db();
		}

		public function add(Editor $editor) {
			$sth = $this->db->prepare("INSERT INTO editor(name, link) VALUES(:name, :link)");
			$sth->bindValue(':name', $editor->getName());
			$sth->bindValue(':link', $editor->getLink());
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function update(Editor $editor) {
			$sth = $this->db->prepare("UPDATE editor SET name = :name, link = :link WHERE id = :id");
			$sth->bindValue(':name', $editor->getName());
			$sth->bindValue(':link', $editor->getLink());
			$sth->bindValue(':id', $editor->getId(), PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteById($id) {

			/* Delete game first */
			$gm = new GameManager();
			$gm->deleteByEditorId($id);

			$sth = $this->db->prepare("DELETE FROM
									   editor
								 	   WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function getEditorById($id) {
			$sth = $this->db->prepare("SELECT * FROM editor WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			return new Editor($sth->fetch(PDO::FETCH_ASSOC));
		}

		public function getEditors() {
			$sth = $this->db->query("SELECT * FROM editor");
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}