<?php require 'header.php' ?>

<!-- Guitars bidon  -->
<?php $guitars = [['id_guitar' => '1', 'manufacturer' => 'Test', 'type' => 'Test', 'model' => 'Test', 'year' => '2000', 'price' => '199.99', 'strings' => 6]]; ?>


<div class="container mt-5">

	<h1 class="row mx-1"><span>List of guitars</span><i data-toggle="modal" data-target="#add" class="add far fa-plus-square text-info ml-auto"></i></h1>

	<table class="table table-hover text-center z-depth-4">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Number</th>
				<th scope="col">Manufacturer</th>
				<th scope="col">Type</th>
				<th scope="col">Model</th>
				<th scope="col">Year</th>
				<th scope="col">Price (€)</th>
				<th scope="col">Number of strings</th>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($guitars as $idx => $guitar): ?>
				<tr>
					<td><?= $idx ?></td>
					<?php foreach ($guitar as $key => $value): ?>
						<?php if ($key == 'price'): ?>
							<td><?= number_format($value, 2, ',', ' ') ?> &euro;</td>
						<?php elseif ($key != 'id_guitar'): ?>
							<td><?= utf8_encode($value) ?></td>
						<?php endif; ?>
					<?php endforeach; ?>
					<td><a href=""><i data-id="1" class="edit fas fa-edit text-warning"></i></a></td>
					<td><a href=""><i data-id="1" class="delete fas fa-trash text-danger"></i></a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php include 'inc/libraries.php' ?>
<?php require 'inc/footer.php' ?>