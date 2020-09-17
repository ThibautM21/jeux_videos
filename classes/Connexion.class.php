<?php

	class Connexion {

		const USER = 'jeux_videos';
		const PASSWORD = 'jeux_videos';
		const SERVER = 'fabien-vincent.fr';
		const ERRMODE = PDO::ERRMODE_EXCEPTION;
		const DATABASE = 'jeux_videos';

		private $db, $dataBase;

		public function __construct() {
			$this->connexionDB();
		}

		protected function connexionDB() {
			try {
				$this->db = new PDO('mysql:host='.self::SERVER.';dbname='.self::DATABASE, self::USER, self::PASSWORD);
				$this->db->setAttribute(PDO::ATTR_ERRMODE, self::ERRMODE);
			} catch (PDOException $e) {
				echo '<div class="mt-5 alert alert-danger">'.$e->getMessage().'</div>';
				die();
			}
		}

		public function __sleep() {
			return ['dataBase'];
		}

		public function __wakeup() {
			$this->connexionDB();
		}

		public function db() {
			return $this->db;
		}
	}