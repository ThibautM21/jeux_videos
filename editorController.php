<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	unset($_SESSION['error']);
	unset($_SESSION['success']);

	require 'inc/autoload.php';
	$em = new EditorManager();

	if (isset($_POST['action']) && !empty($_POST['action'])) {

		/* Add action */
		if ($_POST['action'] == 'add') {
			try {

				if (!isset($_POST['name']) || empty($_POST['name']))
					throw new Exception('Editor name is mandatory !');

				if (!isset($_POST['link']) || empty($_POST['link']))
					throw new Exception('Editor link is mandatory !');

				$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
				$link = filter_var($_POST['link'], FILTER_SANITIZE_URL);

				$editor = new Editor(['name' => $_POST['name'], 'link' => $_POST['link']]);
				if ($em->add($editor)) {
					$_SESSION['success'] = 'Editor "'.$_POST['name'].'" added successfully !';
				} else {
					$_SESSION['error'] = 'Unable to add editor "'.$_POST['name'].'"!';
				}

			} catch (Exception $e) {
				$_SESSION['error'] = $e->getMessage();
			}
		/* Delete action */
		} else if ($_POST['action'] == 'delete') {
			if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
				$name = $em->getEditorById($_POST['delete_id'])->getName();
				if ($em->deleteById($_POST['delete_id'])) {
					$_SESSION['success'] = 'Editor "'.$name.'" deleted successfully !';
				} else {
					$_SESSION['error'] = 'Unable to delete editor "'.$name.'"!';
				}
			}
		/* Edit action */
		} else if ($_POST['action'] == 'edit') {
			try {

				if (!isset($_POST['edit_id']) || empty($_POST['edit_id']))
					throw new Exception('Unable to edit this editor !');

				if (!isset($_POST['edit_name']) || empty($_POST['edit_name']))
					throw new Exception('Editor name is mandatory !');

				if (!isset($_POST['edit_link']) || empty($_POST['edit_link']))
					throw new Exception('Editor link is mandatory !');

				$name = filter_var($_POST['edit_name'], FILTER_SANITIZE_STRING);
				$link = filter_var($_POST['edit_link'], FILTER_SANITIZE_URL);

				$editor = $em->getEditorById($_POST['edit_id']);
				$editor->setName($name);
				$editor->setLink($link);

				if ($em->update($editor)) {
					$_SESSION['success'] = 'Editor "'.$name.'" edited successfully !';
				} else {
					$_SESSION['error'] = 'Unable to edit editor "'.$name.'" !';
				}
			} catch (Exception $e) {
				$_SESSION['error'] = $e->getMessage();
			}
		}
	}

	header('location: editor.php');