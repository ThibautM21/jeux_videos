<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	unset($_SESSION['error']);
	unset($_SESSION['success']);

	require 'inc/autoload.php';
	$vm = new VersionManager();

	if (isset($_POST['action']) && !empty($_POST['action'])) {

		/* Add action */
		if ($_POST['action'] == 'add') {
			try {
				if (!isset($_POST['game_id']) || empty($_POST['game_id']))
					throw new Exception('Game is mandatory.');
				if (!isset($_POST['support_id']) || empty($_POST['support_id']))
					throw new Exception('Support is mandatory.');
				if (!isset($_POST['release_date']) || empty($_POST['release_date']))
					throw new Exception('Release date is mandatory.');
			} catch (Exception $e) {
				$_SESSION['error'] = $e->getMessage();
			}

			$version = new Version($_POST);

			if ($vm->add($version)) {
				$_SESSION['success'] = 'Version added successfully !';
			} else {
				$_SESSION['error'] = 'Unable to add version !';
			}
		/* Delete action */
		} else if ($_POST['action'] == 'delete') {
			if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
				if ($vm->deleteById($_POST['delete_id'])) {
					$_SESSION['success'] = 'Version deleted successfully !';
				} else {
					$_SESSION['error'] = 'Unable to delete version !';
				}
			}
		/* Edit action */
		} else if ($_POST['action'] == 'edit') {

			try {
				if (!isset($_POST['game_id']) || empty($_POST['game_id']))
					throw new Exception('Game is mandatory.');
				if (!isset($_POST['support_id']) || empty($_POST['support_id']))
					throw new Exception('Support is mandatory.');
				if (!isset($_POST['release_date']) || empty($_POST['release_date']))
					throw new Exception('Release date is mandatory.');
			} catch (Exception $e) {
				$_SESSION['error'] = $e->getMessage();
				header('location: version.php');
				exit();
			}

			$version = $vm->getVersionById($_POST['edit_id']);
			$version->setGame_id($_POST['game_id']);
			$version->setSupport_id($_POST['support_id']);
			$version->setRelease_date($_POST['release_date']);
			if ($vm->update($version)) {
				$_SESSION['success'] = 'Version edited successfully !';
			} else {
				$_SESSION['error'] = 'Unable to edit version !';
			}
		}
	}

	header('location: version.php');