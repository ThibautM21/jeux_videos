<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	unset($_SESSION['error']);
	unset($_SESSION['success']);

	require 'inc/autoload.php';
	$cm = new CategoryManager();

	if (isset($_POST['action']) && !empty($_POST['action'])) {

		/* Add action */
		if ($_POST['action'] == 'add') {
			if (isset($_POST['type']) && !empty($_POST['type'])) {
				$category = new Category(['type' => $_POST['type']]);
				if ($cm->add($category)) {
					$_SESSION['success'] = 'Category "'.$_POST['type'].'" added successfully !';
				} else {
					$_SESSION['error'] = 'Unable to add category "'.$_POST['type'].'"!';
				}
			} else {
				$_SESSION['error'] = 'Category type is mandatory !';
			}
		/* Delete action */
		} else if ($_POST['action'] == 'delete') {
			if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
				$type = $cm->getCategoryById($_POST['delete_id'])->getType();
				if ($cm->deleteById($_POST['delete_id'])) {
					$_SESSION['success'] = 'Category "'.$type.'" deleted successfully !';
				} else {
					$_SESSION['error'] = 'Unable to delete category "'.$type.'"!';
				}
			}
		/* Edit action */
		} else if ($_POST['action'] == 'edit') {
			if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])
			 && isset($_POST['edit_type']) && !empty($_POST['edit_type'])) {
				$category = $cm->getCategoryById($_POST['edit_id']);
				$category->setType($_POST['edit_type']);
				if ($cm->update($category)) {
					$_SESSION['success'] = 'Category "'.$_POST['edit_type'].'" edited successfully !';
				} else {
					$_SESSION['error'] = 'Unable to edit category "'.$_POST['edit_type'].'"!';
				}
			} else {
				$_SESSION['error'] = 'Category type is mandatory !';
			}
		}
	}

	header('location: category.php');