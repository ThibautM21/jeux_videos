<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	require 'header.php';
	require 'inc/autoload.php';
	$gm = new GameManager();
	$games = $gm->getGames();

	$cm = new CategoryManager();
	$categories = $cm->getCategories();

	$em = new EditorManager();
	$editors = $em->getEditors();
?>

<div class="container mt-5">

	<h1 class="row mx-1"><span>Games</span><i data-toggle="modal" data-target="#add" class="add far fa-plus-square text-info ml-auto"></i></h1>

	<table class="table table-hover text-center z-depth-4">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Number</th>
				<th scope="col">Image</th>
				<th scope="col">Title</th>
				<th scope="col">Description</th>
				<th scope="col">Link</th>
				<th scope="col">PEGI</th>
				<th scope="col">Category</th>
				<th scope="col">Editor</th>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($games as $idx => $game): ?>
				<tr>
					<td><?= $idx+1 ?></td>
					<?php if (isset($game['image']) && !empty($game['image'])): ?>
						<td><img width=100 height=100 class="img-fluid" src="<?= $game['image'] ?>"></td>
					<?php else: ?>
						<td class='text-muted font-italic'>No image</td>
					<?php endif; ?>
					<td><?= $game['title'] ?></td>
					<td><?= $game['description'] ?></td>
					<td><?= $game['link'] ?></td>
					<td><?= $game['pegi'] ?></td>
					<td><?= $game['type'] ?></td>
					<td><?= $game['name'] ?></td>
					<td><i data-id="<?= $game['id'] ?>" data-toggle="modal" data-target="#edit" class="edit fas fa-edit text-warning"></i></td>
					<td><i data-id="<?= $game['id'] ?>" data-toggle="modal" data-target="#delete" class="delete fas fa-trash text-danger"></i></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
	<div class="alert alert-success z-depth-2">
		<p class="m-0"><?php echo $_SESSION['success'] ?></p>
	</div>
	<?php endif; ?>
	<?php unset($_SESSION['success']) ?>

	<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
	<div class="alert alert-danger z-depth-2">
		<p class="m-0"><?php echo $_SESSION['error'] ?></p>
	</div>
	<?php endif; ?>
	<?php unset($_SESSION['error']) ?>

</div>

<!-- Delete modal  -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-notify modal-danger" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100 text-white">Delete game</h4>
			</div>
			<form class="md-form modal-body" action="gameController.php" method="POST">
				<p>Are you sure you want to delete this game ?</p>
				<input class="form-control" type="hidden" id="delete_id" name="delete_id" value="">
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-outline-danger btn-sm" name="action" value="delete">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Add modal  -->
<div class="modal fade" id="add" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-notify modal-info" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100">Add a game</h4>
			</div>
			<form class="md-form modal-body" id="add_form" action="gameController.php" method="POST" enctype="multipart/form-data">
				<input class="form-control" type="text" id="title" name="title" placeholder="Title">
				<textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
				<input class="form-control" type="text" id="link" name="link" placeholder="Link">
				<input class="form-control" type="number" id="pegi" name="pegi" placeholder="PEGI">
				<select class="form-control mt-3" name="category">
					<option disabled selected>Choose a category</option>
					<?php foreach ($categories as $category): ?>
						<option value="<?= $category['id'] ?>"><?= $category['type'] ?></option>
					<?php endforeach; ?>
				</select>
				<select class="form-control my-3" name="editor">
					<option disabled selected>Choose an editor</option>
					<?php foreach ($editors as $editor): ?>
						<option value="<?= $editor['id'] ?>"><?= $editor['name'] ?></option>
					<?php endforeach; ?>
				</select>
				<div class="md-form d-flex align-items-center">
					<label class="position-relative mr-1" for="image" class="">Image (max. 3mo) (optional) :</label>
					<label class="position-relative btn btn-primary btn-sm m-0">Browse...<input id="image" type="file" name="image" hidden accept="image/*"></label>
					<p class="picture d-inline my-0 ml-2" id="add_image"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-outline-danger btn-sm" name="action" value="add">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-notify modal-warning" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100">Edit a game</h4>
			</div>
			<form class="md-form modal-body" id="edit_form" action="gameController.php" method="POST" enctype="multipart/form-data">
				<input class="form-control" type="hidden" id="edit_id" name="edit_id" value="">
				<input class="form-control" type="text" id="title" name="title" placeholder="Title" required>
				<textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
				<input class="form-control" type="text" id="link" name="link" placeholder="Link" required>
				<input class="form-control" type="number" id="pegi" name="pegi" placeholder="PEGI" required min=0 max=99>
				<select class="form-control mt-3" name="category">
					<option disabled selected>Choose a category</option>
					<?php foreach ($categories as $category): ?>
						<option value="<?= $category['id'] ?>"><?= $category['type'] ?></option>
					<?php endforeach; ?>
				</select>
				<select class="form-control my-3" name="editor">
					<option disabled selected>Choose an editor</option>
					<?php foreach ($editors as $editor): ?>
						<option value="<?= $editor['id'] ?>"><?= $editor['name'] ?></option>
					<?php endforeach; ?>
				</select>
				<div class="md-form d-flex align-items-center">
					<label class="position-relative mr-1" for="image2" class="">Image (max. 3mo) (optional) :</label>
					<label class="position-relative btn btn-primary btn-sm m-0">Browse...<input id="image2" type="file" name="image" hidden accept="image/*"></label>
					<p class="picture d-inline my-0 ml-2" id="edit_image"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-outline-danger btn-sm" name="action" value="edit">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include 'inc/libraries.php' ?>
<script type="text/javascript" src="js/game.js"></script>
<?php require 'inc/footer.php' ?>