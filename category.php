<?php

	require 'header.php';
	require 'inc/autoload.php';
	$cm = new CategoryManager();
	$categories = $cm->getCategories();
?>

<div class="container mt-5">

	<h1 class="row mx-1"><span>List of categories</span><i data-toggle="modal" data-target="#add" class="add far fa-plus-square text-info ml-auto"></i></h1>

	<table class="table table-hover text-center z-depth-4">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Number</th>
				<th scope="col">Type</th>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($categories as $idx => $category): ?>
				<tr>
					<td><?= $idx+1 ?></td>
					<td><?= $category['type'] ?></td>
					<td><i data-id="<?= $category['id'] ?>" data-toggle="modal" data-target="#edit" class="edit fas fa-edit text-warning"></i></td>
					<td><i data-id="<?= $category['id'] ?>" data-toggle="modal" data-target="#delete" class="delete fas fa-trash text-danger"></i></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-notify modal-danger" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100 text-white">Delete category</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this category ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-outline-danger btn-sm" id="delete_btn">Delete</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-notify modal-info" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100">Add a category</h4>
			</div>

			<div class="modal-body">
				<form class="md-form" id="add_form">
					<input class="form-control" type="text" id="type" name="type" placeholder="Category">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-outline-danger btn-sm" id="add_btn">Add</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-notify modal-warning" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100">Edit a category</h4>
			</div>

			<div class="modal-body">
				<form class="md-form" id="edit_form">
					<input class="form-control" type="text" id="type" name="type" placeholder="Category">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-outline-danger btn-sm" id="edit_btn">Edit</button>
			</div>
		</div>
	</div>
</div>

<?php include 'inc/libraries.php' ?>
<!-- <script type="text/javascript" src="js/category.js"></script> -->
<?php require 'inc/footer.php' ?>