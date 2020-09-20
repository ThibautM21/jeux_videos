<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	require 'header.php';
	require 'inc/autoload.php';
	$vm = new VersionManager();
	$versions = $vm->getVersions();

	$gm = new GameManager();
	$games = $gm->getGames();

	$sm = new SupportManager();
	$supports = $sm->getSupports();
?>

<div class="container mt-5">

	<h1 class="row mx-1"><span>Versions</span><i data-toggle="modal" data-target="#add" class="add far fa-plus-square text-info ml-auto"></i></h1>

	<table class="table table-hover text-center z-depth-4">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Number</th>
				<th scope="col">Game</th>
				<th scope="col">Support</th>
				<th scope="col">Release date</th>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($versions as $idx => $version): ?>
				<tr>
					<td><?= $idx+1 ?></td>
					<td><?= $version['title'] ?></td>
					<td><?= $version['name'] ?></td>
					<td><?= $version['release_date'] ?></td>
					<td><i data-id="<?= $version['id'] ?>" data-toggle="modal" data-target="#edit" class="edit fas fa-edit text-warning"></i></td>
					<td><i data-id="<?= $version['id'] ?>" data-toggle="modal" data-target="#delete" class="delete fas fa-trash text-danger"></i></td>
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
				<h4 class="modal-title w-100 text-white">Delete version</h4>
			</div>
			<form class="md-form modal-body" action="versionController.php" method="POST">
				<p>Are you sure you want to delete this version ?</p>
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
				<h4 class="modal-title w-100">Add a version</h4>
			</div>
			<form class="md-form modal-body" id="add_form" action="versionController.php" method="POST" enctype="multipart/form-data">
				<select class="form-control mt-3" name="game_id">
					<option disabled selected>Choose a game</option>
					<?php foreach ($games as $game): ?>
						<option value="<?= $game['id'] ?>"><?= $game['title'] ?></option>
					<?php endforeach; ?>
				</select>
				<select class="form-control my-3" name="support_id">
					<option disabled selected>Choose a support</option>
					<?php foreach ($supports as $support): ?>
						<option value="<?= $support['id'] ?>"><?= $support['name'] ?></option>
					<?php endforeach; ?>
				</select>
				<input class="form-control" type="date" id="release_date" name="release_date" placeholder="Release date">
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
				<h4 class="modal-title w-100">Edit a version</h4>
			</div>
			<form class="md-form modal-body" id="edit_form" action="versionController.php" method="POST" enctype="multipart/form-data">
				<input class="form-control" type="hidden" id="edit_id" name="edit_id" value="">
				<select class="form-control mt-3" name="game_id">
					<option disabled selected>Choose a game</option>
					<?php foreach ($games as $game): ?>
						<option value="<?= $game['id'] ?>"><?= $game['title'] ?></option>
					<?php endforeach; ?>
				</select>
				<select class="form-control my-3" name="support_id">
					<option disabled selected>Choose a support</option>
					<?php foreach ($supports as $support): ?>
						<option value="<?= $support['id'] ?>"><?= $support['name'] ?></option>
					<?php endforeach; ?>
				</select>
				<input class="form-control" type="date" id="release_date" name="release_date" placeholder="Release date">
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-outline-danger btn-sm" name="action" value="edit">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include 'inc/libraries.php' ?>
<script type="text/javascript" src="js/version.js"></script>
<?php require 'inc/footer.php' ?>