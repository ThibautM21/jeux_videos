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

	<h1 class="row mx-1">Games</h1>

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
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php include 'inc/libraries.php' ?>
<?php require 'inc/footer.php' ?>