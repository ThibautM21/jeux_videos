<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	require 'header.php';
	require 'inc/autoload.php';

	$vm = new VersionManager();
	$versions = $vm->getFullVersions();
?>

<div class="container mt-5">

	<?php foreach ($versions as $idx => $version): ?>
		<div class="row my-5">
			<div class="col-3">
				<p><img class="img-fluid" src="<?= $version['image'] ?>"></p>
			</div>
			<div class="col-8 align-self-center">
				<h2 class="col-12"><?= $version['title'] ?></h2>
				<h3 class="col-12"><span class="text-danger"><?= $version['support'] ?></span><span class="mx-2 text-success"><?= $version['editor'] ?></span></h3>
				<p class="col-12 text-muted"><?= $version['description']?></p>
				<p class="col-12 font-weight-bold">Sortie : <?= $version['release_date'] ?></p>
				<button class="btn btn-info">Plus d'infos</button>
			</div>
		</div>
		<hr>
	<?php endforeach; ?>

</div>

<?php include 'inc/libraries.php' ?>
<?php require 'inc/footer.php' ?>