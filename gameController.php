<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	unset($_SESSION['error']);
	unset($_SESSION['success']);

	require 'inc/autoload.php';
	$gm = new GameManager();

	if (isset($_POST['action']) && !empty($_POST['action'])) {

		/* Add action */
		if ($_POST['action'] == 'add') {
			try {
				if (!isset($_POST['title']) || empty($_POST['title']))
					throw new Exception('Title is mandatory.');
				if (!isset($_POST['description']) || empty($_POST['description']))
					throw new Exception('Description is mandatory.');
				if (!isset($_POST['link']) || empty($_POST['link']))
					throw new Exception('Link is mandatory.');
				if (!isset($_POST['pegi']) || empty($_POST['pegi']))
					throw new Exception('PEGI is mandatory.');
				if (!isset($_POST['categoryory']) || empty($_POST['category']))
					throw new Exception('Category is mandatory.');
				if (!isset($_POST['editor']) || empty($_POST['editor']))
					throw new Exception('Editor is mandatory.');
			} catch (Exception $e) {
				$_SESSION['error'] = $e->getMessage();
			}

			$data = ['title' => $_POST['title'],
							  'description' => $_POST['description'],
							  'link' => $_POST['link'],
							  'pegi' => $_POST['pegi'],
							  'category_id' => $_POST['category'],
							  'editor_id' => $_POST['editor']];


			$image = $_FILES['image'];

			/* If guitar is successfully added, upload the image */
			if (isset($image) && !empty($image) && !empty($image['name'])) {
				if (empty($image['tmp_name']) || explode('/', $image['type'])[0] != 'image')
					throw new Exception('Please specify an image (.jpg, .png, .gif)!');

				if ($image['size'] > 3*1024*1024)
					throw new Exception('Image is too heavy ! (max: 3mo)');

				$path_parts = pathinfo($image['name']);
				$filename = 'upload/'.$path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
				if (!move_uploaded_file($image['tmp_name'], $filename))
					throw new Exception('Error during upload of file '.$image['name'].'!');

				$data['image'] = $filename;
			}

			$game = new Game($data);

			if ($gm->add($game)) {
				$_SESSION['success'] = 'Game "'.$_POST['title'].'" added successfully !';
			} else {
				$_SESSION['error'] = 'Unable to add game "'.$_POST['title'].'"!';
			}
		/* Delete action */
		} else if ($_POST['action'] == 'delete') {
			if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
				$title = $gm->getGameById($_POST['delete_id'])->getTitle();
				if ($gm->deleteById($_POST['delete_id'])) {
					$_SESSION['success'] = 'Game "'.$title.'" deleted successfully !';
				} else {
					$_SESSION['error'] = 'Unable to delete game "'.$title.'"!';
				}
			}
		/* Edit action */
		} else if ($_POST['action'] == 'edit') {

			try {
				if (!isset($_POST['title']) || empty($_POST['title']))
					throw new Exception('Title is mandatory.');
				if (!isset($_POST['description']) || empty($_POST['description']))
					throw new Exception('Description is mandatory.');
				if (!isset($_POST['link']) || empty($_POST['link']))
					throw new Exception('Link is mandatory.');
				if (!isset($_POST['pegi']) || empty($_POST['pegi']))
					throw new Exception('PEGI is mandatory.');
				if (!isset($_POST['category']) || empty($_POST['category']))
					throw new Exception('Category is mandatory.');
				if (!isset($_POST['editor']) || empty($_POST['editor']))
					throw new Exception('Editor is mandatory.');
			} catch (Exception $e) {
				$_SESSION['error'] = $e->getMessage();
				header('location: game.php');
				exit();
			}

			$image = $_FILES['image'];

			if (isset($image) && !empty($image) && !empty($image['name'])) {
				if (empty($image['tmp_name']) || explode('/', $image['type'])[0] != 'image')
					throw new Exception('Please specify an image (.jpg, .png, .gif)!');

				if ($image['size'] > 3*1024*1024)
					throw new Exception('Image is too heavy ! (max: 3mo)');

				$path_parts = pathinfo($image['name']);
				$filename = 'upload/'.$path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
				if (!move_uploaded_file($image['tmp_name'], $filename))
					throw new Exception('Error during upload of file '.$image['name'].'!');
			}

			$game = $gm->getGameById($_POST['edit_id']);
			$game->setTitle($_POST['title']);
			$game->setDescription($_POST['description']);
			$game->setLink($_POST['link']);
			$game->setPegi($_POST['pegi']);
			$game->setCategory_id($_POST['category']);
			$game->setEditor_id($_POST['editor']);

			if ($game->getImage())
				unlink($game->getImage());

			if (isset($filename))
				$game->setImage($filename);

			if ($gm->update($game)) {
				$_SESSION['success'] = 'Game "'.$_POST['title'].'" edited successfully !';
			} else {
				$_SESSION['error'] = 'Unable to edit game "'.$_POST['title'].'"!';
			}
		}
	}

	header('location: game.php');