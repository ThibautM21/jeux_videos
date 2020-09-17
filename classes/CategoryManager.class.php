<?php

	class CategoryManager {

		private $db;

		public function __construct() {
			$conn = new Connexion();
			$this->db = $conn->db();
		}

		public function add(Category $category) {
			$sth = $this->db->prepare("INSERT INTO category(type) VALUES(:type)");
			$sth->bindValue(':type', $category->getType());
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function update(Category $category) {
			$sth = $this->db->prepare("UPDATE category SET type = :type WHERE id = :id");
			$sth->bindValue(':type', $category->getType());
			$sth->bindValue(':id', $category->getId(), PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function deleteByID($id) {

			/* Delete game first */
			$gm = new GameManager();
			$gm->deleteByCategoryId($id);

			$sth = $this->db->prepare("DELETE FROM
									   category
								 	   WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return $sth->rowCount();
		}

		public function getCategoryById($id) {
			$sth = $this->db->prepare("SELECT * FROM category WHERE id = :id");
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$sth->closeCursor();
			return new Category($sth->fetch(PDO::FETCH_ASSOC));
		}

		public function getCategories() {
			$sth = $this->db->query("SELECT * FROM category");
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}