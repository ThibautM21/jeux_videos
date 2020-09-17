<?php

	class GameManager {

		private $db;

		public function __construct() {
			$conn = new Connexion();
			$this->db = $conn->db();
		}

		public function add(Game $game) {
			$sth = $this->db->prepare("INSERT INTO
									   game(
									   title,
									   description,
									   image,
									   link,
									   pegi,
									   category_id,
									   editor_id)
									   VALUES(
									   :title,
									   :description,
									   :image,
									   :link,
									   :pegi,
									   :category_id,
									   :editor_id)");
			$sth->bindValue(':title', $game->getTitle());
			$sth->bindValue(':description', $game->getDescription());
			$sth->bindValue(':image', $game->getImage());
			$sth->bindValue(':link', $game->getLink());
			$sth->bindValue(':pegi', $game->getPegi(), PDO::PARAM_INT);
			$sth->bindValue(':category_id', $game->getCategory_id(), PDO::PARAM_INT);
			$sth->bindValue(':editor_id', $game->getEditor_id(), PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function update(Game $game) {
			$sth = $this->db->prepare("UPDATE
									   game
									   SET
									   title = :title,
									   description = :description,
									   image = :image,
									   link = :link,
									   pegi = :pegi,
									   category_id = :category_id,
									   editor_id = :editor_id
									   WHERE
									   id = :id");
			$sth->bindValue(':title', $game->getTitle());
			$sth->bindValue(':description', $game->getDescription());
			$sth->bindValue(':image', $game->getImage());
			$sth->bindValue(':link', $game->getLink());
			$sth->bindValue(':pegi', $game->getPegi(), PDO::PARAM_INT);
			$sth->bindValue(':category_id', $game->getCategory_id(), PDO::PARAM_INT);
			$sth->bindValue(':editor_id', $game->getEditor_id(), PDO::PARAM_INT);
			$sth->bindValue(':id', $Game->getId(), PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteById($id) {

			/* Delete associated versions first */
			$vm = new VersionManager();
			$vm->deleteByGameId();

			$sth = $this->db->prepare("DELETE FROM
									   game
								 	   WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteByCategoryId($id) {

			$sth = $this->db->prepare("SELECT * FROM
									   game
								 	   WHERE category_id = :category_id");
			$sth->bindValue(':category_id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();

			while($game = $sth->fetch(PDO::FETCH_ASSOC)) {
				$this->deleteById($game['id']);
			}

			return $sth->rowCount();
		}

		public function deleteByEditorId($id) {
			$sth = $this->db->prepare("SELECT * FROM
									   game
								 	   WHERE editor_id = :editor_id");
			$sth->bindValue(':editor_id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();

			while($game = $sth->fetch(PDO::FETCH_ASSOC)) {
				$this->deleteById($game['id']);
			}

			return $sth->rowCount();
		}

		public function getGameById($id) {
			$sth = $this->db->prepare("SELECT * FROM game WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return new Game($sth->fetch(PDO::FETCH_ASSOC));
		}

		public function getGamesByCategoryId($id) {
			$sth = $this->db->prepare("SELECT * FROM game WHERE category_id = :category_id");
			$sth->bindValue(':category_id', $id);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getGamesByEditorId($id) {
			$sth = $this->db->prepare("SELECT * FROM game WHERE editor_id = :editor_id");
			$sth->bindValue(':editor_id', $id);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getGames() {
			$sth = $this->db->query("SELECT * FROM game");
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}