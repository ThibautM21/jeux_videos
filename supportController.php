<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	unset($_SESSION['error']);
	unset($_SESSION['success']);

	require 'inc/autoload.php';
	$sm = new SupportManager();

	if (isset($_POST['action']) && !empty($_POST['action'])) {

		/* Add action */
		if ($_POST['action'] == 'add') {
			if (isset($_POST['name']) && !empty($_POST['name'])) {
				$support = new Support(['name' => $_POST['name']]);
				if ($sm->add($support)) {
					$_SESSION['success'] = 'Support "'.$_POST['name'].'" added successfully !';
				} else {
					$_SESSION['error'] = 'Unable to add support "'.$_POST['name'].'"!';
				}
			} else {
				$_SESSION['error'] = 'Support name is mandatory !';
			}
		/* Delete action */
		} else if ($_POST['action'] == 'delete') {
			if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
				$name = $sm->getSupportById($_POST['delete_id'])->getName();
				if ($sm->deleteById($_POST['delete_id'])) {
					$_SESSION['success'] = 'Support "'.$name.'" deleted successfully !';
				} else {
					$_SESSION['error'] = 'Unable to delete support "'.$name.'"!';
				}
			}
		/* Edit action */
		} else if ($_POST['action'] == 'edit') {
			if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])
			 && isset($_POST['edit_name']) && !empty($_POST['edit_name'])) {
				$support = $sm->getSupportById($_POST['edit_id']);
				$support->setName($_POST['edit_name']);
				if ($sm->update($support)) {
					$_SESSION['success'] = 'Support "'.$_POST['edit_name'].'" edited successfully !';
				} else {
					$_SESSION['error'] = 'Unable to edit support "'.$_POST['edit_name'].'"!';
				}
			} else {
				$_SESSION['error'] = 'Support name is mandatory !';
			}
		}
	}

	header('location: support.php');