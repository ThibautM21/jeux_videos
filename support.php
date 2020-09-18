<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	require 'header.php';
	require 'inc/autoload.php';
	$sm = new SupportManager();
	$supports = $sm->getSupports();
?>

<div class="container mt-5">

	<h1 class="row mx-1"><span>Supports</span><i data-toggle="modal" data-target="#add" class="add far fa-plus-square text-info ml-auto"></i></h1>

	<table class="table table-hover text-center z-depth-4">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Number</th>
				<th scope="col">Name</th>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($supports as $idx => $support): ?>
				<tr>
					<td><?= $idx+1 ?></td>
					<td><?= $support['name'] ?></td>
					<td><i data-id="<?= $support['id'] ?>" data-toggle="modal" data-target="#edit" class="edit fas fa-edit text-warning"></i></td>
					<td><i data-id="<?= $support['id'] ?>" data-toggle="modal" data-target="#delete" class="delete fas fa-trash text-danger"></i></td>
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
				<h4 class="modal-title w-100 text-white">Delete support</h4>
			</div>
			<form class="md-form modal-body" action="supportController.php" method="POST">
				<p>Are you sure you want to delete this support ?</p>
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
				<h4 class="modal-title w-100">Add a support</h4>
			</div>
			<form class="md-form modal-body" id="add_form" action="supportController.php" method="POST">
				<input class="form-control" type="text" id="name" name="name" placeholder="Support">
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
				<h4 class="modal-title w-100">Edit a support</h4>
			</div>
			<form class="md-form modal-body" action="supportController.php" method="POST">
				<input class="form-control" type="hidden" id="edit_id" name="edit_id" value="">
				<input class="form-control" type="text" id="edit_name" name="edit_name" placeholder="Support" value="">
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-outline-danger btn-sm" name="action" value="edit">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include 'inc/libraries.php' ?>
<script type="text/javascript" src="js/support.js"></script>
<?php require 'inc/footer.php' ?>